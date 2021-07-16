<?php
declare(strict_types=1);

namespace Fastknife\Utils;


class RandomUtils
{
    /**
     * 获取随机数
     * @param $min
     * @param $max
     * @return int
     * @throws \Exception
     */
    public static function getRandomInt($min, $max){
        return random_int(intval($min), intval($max));
    }

    /**
     * 随机获取眼色值
     * @return array
     * @throws \Exception
     */
    public static function getRandomColor(){
         return [random_int(1, 255), random_int(1, 255), random_int(1, 255)];
    }

    /**
     * 随机获取角度
     * @param int $start
     * @param int $end
     * @return int
     * @throws \Exception
     */
    public static function getRandomAngle($start = -45, $end = 45){
         return random_int($start, $end);
    }

    /**
     * 随机获取汉字
     * @param $num int 生成汉字的数量
     * @return array
     * @throws \Exception
     */
    public static function getRandomChar($num)
    {
        $b = [];
        for ($i=0; $i<$num; $i++) {
            // 使用chr()函数拼接双字节汉字，前一个chr()为高位字节，后一个为低位字节
            $a = chr(random_int(0xB0,0xD0)).chr(random_int(0xA1, 0xF0));
            // 转码
            $h = iconv('GB2312', 'UTF-8', $a);
            if(!in_array($h, $b)){
                $b[] = $h;
            }else{
                $i--; //去重
            }
        }
        return $b;
    }

    /**
     * @throws \Exception
     */
    public static function getUUID($prefix = '')
    {
        $chars = md5(uniqid((string) random_int(1, 100), true));
        $uuid  = substr($chars,0,8) . '-';
        $uuid .= substr($chars,8,4) . '-';
        $uuid .= substr($chars,12,4) . '-';
        $uuid .= substr($chars,16,4) . '-';
        $uuid .= substr($chars,20,12);
        return $prefix . $uuid;
    }

    /**
     * 获取随机字符串编码
     * @param integer $length 字符串长度
     * @param integer $type 字符串类型(1纯数字,2纯字母,3数字字母)
     * @return string
     * @throws \Exception
     */
    public static function getRandomCode($length = 10, $type = 1)
    {
        $numbs = '0123456789';
        $chars = 'abcdefghijklmnopqrstuvwxyz';
        if (intval($type) === 1) $chars = $numbs;
        if (intval($type) === 2) $chars = "a{$chars}";
        if (intval($type) === 3) $chars = "{$numbs}{$chars}";
        $string = $chars[random_int(1, strlen($chars) - 1)];
        if (isset($chars)) while (strlen($string) < $length) {
            $string .= $chars[random_int(0, strlen($chars) - 1)];
        }
        return $string;
    }
}
