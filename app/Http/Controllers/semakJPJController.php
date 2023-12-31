<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use App\InputDL;
use App\ExtractDL;
use App\ScrapedJPJ;

class semakJPJController extends Controller
{
    public function verify_jpj(Request $request)
    {
        $process = shell_exec("python semakjpj.py");
        return redirect()->route('verification_dl.show_jpj');

        #$latestRow = InputDl::latest()->first();
        #$up = $latestRow->input_dlResult;
        #echo $up;

        /*// Define the path to your Python script
        $scriptPath = 'semakjpj2.py';
        
        // Create a new process instance and run the script
        $process = new Process(['python', $scriptPath]);
        $process->setTimeout(180); // set timeout to 60 seconds
        $process->run();
        
        // Check if the process ran successfully
        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }
        
        // Output the script's result
        return $process->getOutput();*/

        /*#$url = $request->input('url');
        $output = exec('node testpup.js');
        var_dump($output);
        #echo "oi";*/
        /*$latest_dl = ExtractDL::orderBy('id', 'desc')->first();
        $icNum = $latest_dl->dl_ID;

        $capabilities = DesiredCapabilities::chrome();
        #$capabilities->setCapability('acceptSslCerts', false);
        $chromeOptions = new ChromeOptions();
        $chromeOptions->addArguments([
            '--disable-gpu',
            '--headless',
            '--ignore-certificate-errors',
        ]);
        $capabilities->setCapability(ChromeOptions::CAPABILITY, $chromeOptions);
        
        $driver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $capabilities);
        $driver->get('https://www.jpj.gov.my/web/main-site/semakan-tarikh-luput-lesen-memandu');

        $select_element = $driver->findElement(WebDriverBy::id('_drivinglicense_WAR_JPJDXPPluginportlet_catid'));
        $select = new WebDriverSelect($select_element);
        $select->selectByValue('1');
        $driver->findElement(WebDriverBy::id('_drivinglicense_WAR_JPJDXPPluginportlet_idNumber'))->sendKeys($icNum);

        $driver->wait(10, 500)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::className('captcha')));
        $captcha_img = $driver->findElement(WebDriverBy::className('captcha'));
        $captcha_img->takeScreenshot('D:\\Shortcut\\laragon\\www\\project\\public\\captchas\\captcha.png');

        require(__DIR__ . 'D:\\Shortcut\\laragon\\www\\project\\public\\src\\autoloader.php');

        $solver = new \TwoCaptcha\TwoCaptcha('7ef16b5d6c0511db3fe5fc1300d45e66');

        try {
            $result = $solver->normal(__DIR__ . 'D:\\Shortcut\\laragon\\www\\project\\public\\captchas\\captcha.png');
        } catch (\Exception $e) {
            die($e->getMessage());
        }
        //$code = $result->code;
        #or
        $code = $result['code'];
        
        $driver->findElement(WebDriverBy::id('_drivinglicense_WAR_JPJDXPPluginportlet_captchaText'))->sendKeys($code);
        $driver->findElement(WebDriverBy::xpath('//*[@id="submitAjax"]'))->click();

        $driver->wait(60, 1000)->until(
            WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector('#resultAjax .box'))
        );
        $html = $driver->getPageSource();
        $crawler = new Crawler();
        $crawler->addHtmlContent($html);
        $span = $crawler->filter('span#resultAjax');
        //$soup = new simple_html_dom();
        //$soup->load($html);
        //$span = $soup->find('span', 'resultAjax');
        if ($span->filter('p[align="left"]')->count() > 0) {
            $latestRow = InputDl::latest()->first();
            $latestRow->input_dlResult = 'TRUE';
            $latestRow->save();
        }
        else {
            $latestRow = InputDl::latest()->first();
            $latestRow->input_dlResult = 'FALSE';
            $latestRow->save();
        }
        $driver->close();
        $driver->quit();
        return redirect()->route('verification_dl.show_jpj');*/
        /*$descriptorspec = array(
            0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
            1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
            2 => array("pipe", "w")   // stderr is a pipe that the child will write to
         );
         
         $process = proc_open('python semakjpj2.py', $descriptorspec, $pipes);
         
         if (is_resource($process)) {
            while(proc_get_status($process)['running']){
                sleep(120);
            }
            $result = stream_get_contents($pipes[1]);
            fclose($pipes[1]);
            $return_value = proc_close($process);
            if($return_value == 0) {
                $message = "Successfully updated the value in the database";
            } else {
                $message = "Error while updating the value in the database";
            }
            #return redirect()->route('verification_dl.show_jpj', ['message' => $message]);
            echo $message;
        }
        $process = exec("python semakjpj2.py");
        sleep(120);
        return redirect()->route('verification_dl.show_jpj');*/
    }

    public function show_jpj()
    {
        $latestID = InputDL::orderBy('id', 'desc')->first();
        $latestIDextract = ExtractDL::orderBy('id', 'desc')->first();
        $latestIDscrape = ScrapedJPJ::orderBy('id', 'desc')->first();
        $id = array($latestID->input_dlID);
        $jpj_res = $latestID->input_dlResult;
        $m_one = array('The driving license ID: ');
        $m_two = array('is verified as VALID by Jabatan Pengangkutan Jalan Malaysia ');
        $m_three = array('is verified as INVALID by Jabatan Pengangkutan Jalan Malaysia ');
        #global $message;

        if ($jpj_res == 'default') {
            return view('errors.nojpj');
        }
        else {
            if ($jpj_res == 'TRUE') {
                $message_jpj = array_merge($m_one, $id, $m_two); 
                $message_jpj = implode(' ', $message_jpj);
                return view('verification_dl.showjpj', compact('message_jpj', 'latestID', 'latestIDextract', 'latestIDscrape'));
            }
            else {
                $message_jpj = array_merge($m_one, $id, $m_three);
                $message_jpj = implode(' ', $message_jpj);
                return view('verification_dl.showjpj', compact('message_jpj', 'latestID', 'latestIDextract', 'latestIDscrape'));
            } 
        }
        /*
        #if ($message == "Successfully updated the value in the database"){
            if ($jpj_res == 'TRUE') {
                $message_jpj = array_merge($m_one, $id, $m_two); 
                $message_jpj = implode(' ', $message_jpj);
                return view('verification_dl.showjpj', compact('message_jpj'));
            }
            if ($jpj_res == 'default') {
                return view('errors.nojpj');
            }
            else {
                $message_jpj = array_merge($m_one, $id, $m_three);
                $message_jpj = implode(' ', $message_jpj);
                return view('verification_dl.showjpj', compact('message_jpj'));
            }
        /*}
        else {
            return ('jpj unsuccessful');
        }*/
    }
}
