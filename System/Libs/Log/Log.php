<?php
/** @noinspection ALL */
/*************************************************
 * TheYkk's fw
 * Log Library
 *
 * Author 	: Yusuf Kaan Karakaya
 * Web 		: http://theykk.net
  *
 * Github	: http://github.com/theykk/fw
 * License	: MIT
 *
 *************************************************/
namespace System\Libs\Log;

use System\Libs\Exception\ExceptionHandler;

class Log
{

    protected $cols = [
            '(\[DEBUG\])'=>'#4A90E2',
            '(\[info\])'=>'#4A90E2',
            '(\[ALERT\])'=>'#E23636',
            '(\[critical\])'=>'#cc0000',
            '(\[error\])'=>'#E23636',
            '(\[emergency\])'=>'#ff0033',
            '(\[warning\])'=>'#EDB95E',
            '(\[notice\])'=>'#EDB95E',
            '(\[success\])'=>'#82DD55',
        ];
	/**
	 * Save log as emergency
	 *
	 * @param string $message
	 * @throws \Exception
	 */
	public function emergency($message)
	{
		$this->write('emergency', $message);
	}

	/**
	 * Save log as alert
	 *
	 * @param string $message
	 * @throws \Exception
	 */
	public function alert($message)
	{
		$this->write('alert', $message);
	}

	/**
	 * Save log as critical
	 *
	 * @param string $message
	 * @throws \Exception
	 */
	public function critical($message)
	{
		$this->write('critical', $message);
	}

	/**
	 * Save log as error
	 *
	 * @param string $message
	 * @throws \Exception
	 */
	public function error($message)
	{
		$this->write('error', $message);
	}

	/**
	 * Save log as warning
	 *
	 * @param string $message
	 * @throws \Exception
	 */
	public function warning($message)
	{
		$this->write('warning', $message);
	}

	/**
	 * Save log as notice
	 *
	 * @param string $message
	 * @throws \Exception
	 */
	public function notice($message)
	{
		$this->write('notice', $message);
	}

	/**
	 * Save log as info
	 *
	 * @param string $message
	 * @throws \Exception
	 */
	public function info($message)
	{
		$this->write('info', $message);
	}

	/**
	 * Save log as debug
	 *
	 * @param string $message
	 * @throws \Exception
	 */
	public function debug($message)
	{
		$this->write('debug', $message);
	}

    /**
     * Write logs to file
     *
     * @param string $level
     * @param string $message
     * @throws \Exception
     */
	protected function write($level, $message)
	{
		if (is_array($message))
			$message = serialize($message);

		$logText = '[' . date('Y-m-d H:i:s') . '] - [' . strtoupper($level) . '] ---> ' . $message;
		$this->save($logText);
	}

    /**
     * Save Log
     *
     * @param string $logText
     * @throws \Exception
     */
	protected function save($logText)
	{
		$fileName 	= 'Log_' . date('Y-m-d') . '.log';
		$file 		= fopen(APP_DIR . 'Storage/Logs/' . $fileName, 'a');

		if (fwrite($file, $logText . "\n") === false)
			throw new ExceptionHandler("Hata", "Log dosyası oluşturulamadı. Yazma izinlerini kontrol ediniz.");

		fclose($file);
	}

    public function show($day=0) {
        $fileName 	= 'Log_' .  date('Y-m-d', strtotime(date('Y-m-d'). ' - '.$day.' days')). '.log';
        $file 		= APP_DIR . 'Storage/Logs/' . $fileName;

        if(!file_exists($file)){
            echo 'log file not found '.$file;
            exit;
        }
        //Strip code and first span
        $code = substr(highlight_file($file, true), 36, -15);
        //Split lines
        $lines = explode('<br />', $code);
        //Count
        $lineCount = count($lines);
        //Calc pad length
        $padLength = strlen($lineCount);

        //Re-Print the code and span again
        echo "<code><span style=\"color: #000000;font-size:20px\">";

        //Loop lines
        foreach($lines as $i => $line) {

            foreach ($this->cols as $pat => $cal) {
                if(preg_match($pat,$line)){
                    $line = '<span style="color: '. $cal.'">'.$line.'</span>';
                }
            }

            //Create line number
            $lineNumber = str_pad($i + 1,  $padLength, '0', STR_PAD_LEFT);
            //Print line
            echo sprintf('<br><span style="color: #999999">%s | </span>%s', $lineNumber, $line);
        }

        //Close span
        echo "</span></code>";
    }
}
