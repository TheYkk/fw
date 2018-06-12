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
        'num' => 'font-weight:bold; color:#1299DA',
        'const' => 'font-weight:bold',
        'str' => 'font-weight:bold; color:#56DB3A',
        'note' => 'color:#1299DA',
        'ref' => 'color:#A0A0A0',
        'public' => 'color:#FFFFFF',
        'protected' => 'color:#FFFFFF',
        'private' => 'color:#FFFFFF',
        'meta' => 'color:#B729D9',
        'key' => 'color:#56DB3A',
        'index' => 'color:#1299DA',
        'ellipsis' => 'color:#FF8400',
    );
    protected $tos = [
        'string'=>'key',
        'integer'=>'index',
        'float'=>'index',
        'boolean'=>'ellipsis'
    ];
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
                        $color_type = null;
                        if (array_key_exists($typek, $this->tos)) {

                            $color_type = $this->tos[$typek];
                            $color_type = $this->styles[$color_type];

                        }


                        /**
                         * Value icin type belirleme
                         */
                        $type      = gettype($v);
                        $color_val = null;

                        if (array_key_exists($type, $this->tos)) {
                            $color_val = $this->tos[$type];
                            $color_val = $this->styles[$color_val];
                        }
                        //Key
                        $output .= $tab . "<span style='$color_type'>" . ($typek === 'string' ? '"' . $k . '"' : ($typek === 'boolean' ? ($k === true ? 'true' : 'false') : $k)) . "</span> => ";
                        //val
                        $output .= "<span style='" . $color_val . "'>" . ($type === 'string' ? '"' . $v . '"' : ($type === 'boolean' ? ($v === true ? 'true' : 'false') : $v)) . "</span> ";
                        //Yeni Satir
                        $output .= $eof;
                    } else {
                        $typek      = gettype($k);
                        $color_type = null;
                        if (array_key_exists($typek, $this->tos)) {

                            $color_type = $this->tos[$typek];
                            $color_type = $this->styles[$color_type];
                        }

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
