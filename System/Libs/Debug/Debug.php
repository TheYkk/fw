<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12.06.2018
 * Time: 16:24
 */

namespace System\Libs\Debug;
class Debug
{
    protected $styles = array(
        'default' => 'background-color:#18171B; color:#FF8400; line-height:1.2em; font:12px Menlo, Monaco, Consolas, monospace; word-wrap: break-word; white-space: pre-wrap; position:relative; z-index:99999; word-break: break-all',
        'note' => 'color:#1299DA',
        'string' => 'color:#56DB3A',
        'integer' => 'color:#1299DA',
        'float' => 'color:#1299DA',
        'double' => 'color:#1299DA',
        'boolean' => 'color:#FF8400',
    );
    public function __construct($data)
    {

        $output  = '<pre style="'.$this->styles['default'].'">';
        $output .= $this->_output($data);
        $output .= '</pre>';

        echo $output;

    }

    function _output($data ,Int $start = 0)
    {

        $output = '';
        $eof    = '<br>';
        $tab    = str_repeat('&nbsp;', ($start+1)*4);
        $tabend = str_repeat('&nbsp;', $start*4);

        $vartype = 'array';

        if( is_object($data) )
        {
            $data = (array) $data;
            $vartype = 'object';
        }

        if( ! is_array($data) )
        {
            return $data.$eof;
        }
        else
        {
            if (empty($data))
            {
                    $output .= '<span style="'.$this->styles['note'].'"></span>[';
            }
            else {
                $output .= '<span style="' . $this->styles['note'] . '">' . $vartype . ':' . count($data) . ' </span>[' . $eof;

                foreach ($data as $k => $v) {

                    if (is_object($v)) {
                        $v       = (array)$v;
                        $vartype = 'object';
                    }

                    if (!is_array($v)) {

                        $typek      = gettype($k);
                        $color_type = $this->styles[$typek];

                        //Value icin type
                        $type      = gettype($v);
                        $color_val = $this->styles[$type];
                        //Key
                        $output .= $tab . "<span style='$color_type'>" . ($typek === 'string' ? '"' . $k . '"' : ($typek === 'boolean' ? ($k === true ? 'true' : 'false') : $k)) . "</span> => ";
                        //val
                        $output .= "<span style='" . $color_val . "'>" . ($type === 'string' ? '"' . $v . '"' : ($type === 'boolean' ? ($v === true ? 'true' : 'false') : $v)) . "</span> ";
                        //Yeni Satir
                        $output .= $eof;
                    } else {
                        $typek      = gettype($k);
                        $color_type = $this->styles[$typek];

                        
                        $output .= $tab . "<span style='$color_type'>" . ($typek === 'string' ? '"' . $k . '"' : ($typek === 'boolean' ? ($k === true ? 'true' : 'false') : $k)) . "</span> => ";
                        $output .= $this->_output($v, (int)$start+1);

                    }

                }

            }
            $output .= $tabend.']'.$eof;
        }

        return $output;
    }
}
