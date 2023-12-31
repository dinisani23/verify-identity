#print("test script")
from __future__ import print_function
import cv2
import numpy as np
import os
import easyocr
from pylab import rcParams
from IPython.display import Image
rcParams['figure.figsize'] = 8, 16
import glob
import mysql.connector
import datetime

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="attemptdb"
)

#print(mydb)
mycursor = mydb.cursor()

MAX_FEATURES = 500
GOOD_MATCH_PERCENT = 0.15

def alignImages(im1, im2):

    # Convert images to grayscale
    im1Gray = cv2.cvtColor(im1, cv2.COLOR_BGR2GRAY)
    im2Gray = cv2.cvtColor(im2, cv2.COLOR_BGR2GRAY)

    # Detect ORB features and compute descriptors.
    orb = cv2.ORB_create(MAX_FEATURES)
    keypoints1, descriptors1 = orb.detectAndCompute(im1Gray, None)
    keypoints2, descriptors2 = orb.detectAndCompute(im2Gray, None)

    # Match features.
    matcher = cv2.DescriptorMatcher_create(
        cv2.DESCRIPTOR_MATCHER_BRUTEFORCE_HAMMING)
    matches = list(matcher.match(descriptors1, descriptors2, None))

    # Sort matches by score
    matches.sort(key=lambda x: x.distance, reverse=False)

    # Remove not so good matches
    numGoodMatches = int(len(matches) * GOOD_MATCH_PERCENT)
    matches = matches[:numGoodMatches]

    # Draw top matches
    imMatches = cv2.drawMatches(im1, keypoints1, im2, keypoints2, matches, None)
    #cv2.imwrite("matches.jpg", imMatches)

    # Extract location of good matches
    points1 = np.zeros((len(matches), 2), dtype=np.float32)
    points2 = np.zeros((len(matches), 2), dtype=np.float32)

    for i, match in enumerate(matches):
        points1[i, :] = keypoints1[match.queryIdx].pt
        points2[i, :] = keypoints2[match.trainIdx].pt

    # Find homography
    h, mask = cv2.findHomography(points1, points2, cv2.RANSAC)

    # Use homography
    height, width, channels = im2.shape
    im1Reg = cv2.warpPerspective(im1, h, (width, height))

    return im1Reg, h

if __name__ == '__main__':

    # Read reference image
    refFilename = "public\\img\\scanic.jpg"
    #print("Reading reference image : ", refFilename)
    imReference = cv2.imread(refFilename, cv2.IMREAD_COLOR)
    h,w,c = imReference.shape
    imReference = cv2.resize(imReference, (w // 2, h // 2))

    # Read image to be aligned
    list_of_files = glob.glob('storage\\app\\public\\ic\\*jpg') # * means all if need specific format then *.csv
    latest_file = max(list_of_files, key=os.path.getctime)
	#imFilename = latest_file
    #print("Reading image to align : ", imFilename)
    im = cv2.imread(latest_file, cv2.IMREAD_COLOR)
	#print(latest_file)

    #print("Aligning images ...")
    # Registered image will be resotred in imReg.
    # The estimated homography will be stored in h.
    imReg, h = alignImages(im, imReference)
    scale = 0.5
    imgReg = cv2.resize(imReg, (0, 0), None, scale, scale)
	
	# Write aligned image to disk.
	#alignedDir = "D:/Shortcut/laragon/www/attempt/storage/app/public/product/aligned"
    uniq_date = str(datetime.datetime.now().date())
    uniq_time = str(datetime.datetime.now().time())
    for ch in [':','.']:
        if ch in uniq_time:
            uniq_time=uniq_time.replace(ch,"-")
    uniq_filename = 'storage\\app\\public\\ic\\aligned\\' + uniq_date + '_' + uniq_time + '.jpg'
    #uniq_filename = 'D:\\Shortcut\\laragon\\www\\attempt\\storage\\app\\public\\product\\aligned\\' + str(datetime.datetime.now().date()) + '_' + str(datetime.datetime.now().time()).replace(':', '-')+'.jpg'
    #alignedDir = "D:\\Shortcut\\laragon\\www\\attempt\\storage\\app\\public\\product\\aligned"
    #uniq_filename = str(datetime.datetime.now().date()) + '_' + str(datetime.datetime.now().time()).replace(':', '.')+'.jpg'
	#outFilename = os.path.join(alignedDir, uniq_filename)
    #print("Saving aligned image : ", outFilename)
    cv2.imwrite(uniq_filename, imReg)
	#print(outFilename)
    #print(uniq_filename)

reader = easyocr.Reader(['en'])

list_of_files_aligned = glob.glob('storage\\app\\public\\ic\\aligned\\*jpg') # * means all if need specific format then *.csv
latest_file_aligned = max(list_of_files_aligned, key=os.path.getctime)
img = cv2.imread(latest_file_aligned)
#img = cv2.imread(uniq_filename)
h,w,c = img.shape
img = cv2.resize(img, (w * 2, h * 2))
imgShow = img.copy()
imgMask = np.zeros_like(imgShow)
myData = []
per = 25
pixelThreshold = 300
roi = [[(24, 6), (628, 126), 'box', 'header'], 
           [(624, 2), (796, 130), 'box', 'box1'], 
           [(798, 2), (1030, 136), 'box', 'box2'], 
           [(80, 200), (312, 396), 'box', 'box3'],
           [(504, 146), (708, 382), 'box', 'box4'],  
           [(688, 152), (1024, 566), 'box', 'box5'], 
           [(22, 128), (398, 208), 'text', 'IDnum'], 
           [(24, 420), (552, 496), 'text', 'name'], 
           [(34, 498), (356, 660), 'text', 'address'], 
           [(738, 558), (964, 596), 'text', 'citizenship'], 
           [(704, 586), (812, 632), 'text', 'religion'], 
           [(836, 588), (1030, 630), 'text', 'gender']]

for x, r in enumerate(roi):
    cv2.rectangle(imgMask, (r[0][0], r[0][1]), (r[1][0], r[1][1]), (0, 255, 0), cv2.FILLED)
    imgShow = cv2.addWeighted(imgShow, 0.99, imgMask, 0.1, 0)
    imgCrop = imgShow[r[0][1]:r[1][1], r[0][0]:r[1][0]]
    uniq_filename_cropped = 'storage\\app\\public\\ic\\aligned\\cropped\\' + str(datetime.datetime.now().date()) + '_' + str(datetime.datetime.now().time()).replace(':', '.')+'.jpg'
    cv2.imwrite(uniq_filename_cropped, imgCrop)

    if r[2] == 'text':
        output = reader.readtext(imgCrop, detail = 0)
        toDel = ["[", "'", "]"]
        filtered = filter(lambda item: item not in toDel, output)
        output = ' '.join(filtered)
        #print(f'{r[3]} : {output}')
        #print(replaceLine(f'{r[3]}:{pytesseract.image_to_string(imgCrop)}')) #optional later
        myData.append(str(output))
        #print(f'{r[3]}:{pytesseract.image_to_string(imgCrop)}'.replace('/n',','))        
        #if '\n' in pytesseract.image_to_string(imgCrop):
        #if pytesseract.image_to_string(imgCrop) == '/n':
            #print(f'{r[3]}:{pytesseract.image_to_string(imgCrop)}'.replace('/n',','))
            #myData.append(pytesseract.image_to_string(imgCrop))
    if r[2] =='box':
        imgGray = cv2.cvtColor(imgCrop, cv2.COLOR_BGR2GRAY)
        imgThresh = cv2.threshold(imgGray, 170, 255, cv2.THRESH_BINARY_INV)[1]
        totalPixels = cv2.countNonZero(imgThresh)
        if totalPixels > pixelThreshold: totalPixels = "true";
        else: totalPixels = "false"
        #print(f'{r[3]} : {totalPixels}')
        myData.append(totalPixels)
    

########### NAK TEST SCRIPT RUN KE TAK + MASUK DB ###############
sql = "INSERT INTO extracted_data (el_one,el_two,el_three,el_four,el_five,el_six,IDnum, name, address, citizenship, religion, gender) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"
#val = ["John", "Highway 21"]
mycursor.execute(sql, myData)

mydb.commit()

#print("")
#print(myData)
#os.system("php /verification/show.blade.php")