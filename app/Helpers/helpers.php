<?php

use App\Repositories\ConfiguracaoRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use voku\helper\ASCII;
use Illuminate\Database\QueryException;
use App\Models\Tenants\Logs;

if(!function_exists('custom_echo')) {
    function custom_echo($x, $length)
    {
        if(strlen($x)<=$length)
        {
            return $x;
        }
        else
        {
            $y=substr($x,0,$length);
            return $y;
        }
    }
}

if(!function_exists('tempoPassado')) {
    function tempoPassado($timestamp)
    {
        //$timeSince = Carbon::parse($timestamp)->diffForHumans();

        $timeAgo = Carbon::parse($timestamp)->ago();

        return $timeAgo;
    }
}

if(!function_exists('cores')) {
    function cores($cor=null)
    {
        $cores = [
            1 => "info",
            2 => "success",
            3 => "primary",
            4 => "warning",
            5 => "danger",
            6 => "secondary",
            7 => "dark"
        ];

        if (is_null($cor)){
            return $cores;
        }else{
            return $cores[$cor];
        }
    }
}

if(!function_exists('meuIP')) {
    function meuIP()
    {
        $clientIP2 = \Request::getClientIp(true);
        return trim($clientIP2);
    }
}

if(!function_exists('mascara')) {
    function mascara($valor, $formato) {

        switch ($formato){
            case 'cnpj':
                $mascara = "##.###.###/####-##";
                break;
            case 'cpf':
                $mascara = "###.###.###-##";
                break;
            case 'celular':
                $mascara = "(##)# ####-####";
                break;
            case 'cep':
                $mascara = "#####-###";
                break;
        }

        $retorno = '';
        $posicao_valor = 0;

        for($i = 0; $i<=strlen($mascara)-1; $i++) {
            if($mascara[$i] == '#') {
                if(isset($valor[$posicao_valor])) {
                    $retorno .= $valor[$posicao_valor++];
                }
            } else {
                $retorno .= $mascara[$i];
            }
        }
        return $retorno;
    }
}

if(!function_exists('setActive')) {
    function setActive($path)
    {
        //dd(\Request::is($path));
        return \Request::is($path . '*') ? ' active' : '';
    }
}

if(!function_exists('setCollapsed')) {
    function setCollapsed($path)
    {
        return !\Request::is($path . '*') ? ' collapsed' : '';
    }
}

if(!function_exists('setShow')) {
    function setShow($path)
    {
        //dd(\Request::is($path));
        return \Request::is($path . '*') ? ' show' : '';
    }
}

if(!function_exists('dateTimeUsParaDateTimeBr')){
	function dateTimeUsParaDateTimeBr($date)
	{
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i:s');
	}
}

if(!function_exists('dateTimeUsParaBr')){
    function dateTimeUsParaBr($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
    }
}

if(!function_exists('dateTimeUsParaUs')){
    function dateTimeUsParaUs($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }
}

if(!function_exists('dateUsParaBr')){
    function dateUsParaBr($date)
    {
        if ($date != null) {
            return Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
        }
    }
}

if(!function_exists('dateBrParaUs')) {
    function dateBrParaUs($path, $campo = null)
    {
        if ($path != null) {
            if (!preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $path)) {
                return redirect()->back()->with('message_fail', $campo != null ? $campo . ' - ' : '' . 'DATA INVÁLIDO!');
            }
            $myDateTime = \DateTime::createFromFormat('d/m/Y', $path);
            return $myDateTime->format('Y-m-d');
        }
    }
}

if(!function_exists('arrValor')){
	function arrValor($valor)
	{
		return round($valor, 2);
	}
}

if (!function_exists('sanitizeString')) {
    function sanitizeString($string) {

        // matriz de entrada
        $what = array( ";","#","$","%","&","/","=","?","~","^",">","<","ª","º","*","‡","ƒ","°","", "\r", "\n" );

        // matriz de saída
        $by   = array( "."," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," ",   ",",  "|" );

        // devolver a string
        return str_replace($what, $by, $string);
    }
}

if (!function_exists('validaCPF')) {
    function validaCPF($cpf)
    {
        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }
}

if (!function_exists('truncate')) {
	function truncate($string, $limit, $break = ".", $pad = "...")
	{
		// remove html and php tags
		$string = strip_tags($string);

		// return with no change if string is shorter than $limit
		if (strlen($string) <= $limit)
			return $string;

		// is $break present between $limit and the end of the string?
		if (false !== ($breakpoint = strpos($string, $break, $limit))) {
			if ($breakpoint < strlen($string) - 1) {
				$string = substr($string, 0, $breakpoint) . $pad;
			}
		}

		return $string;
	}
}

if (!function_exists('simple_truncate')) {
	function simple_truncate($string, $limit)
	{
		// remove html and php tags
		$string = strip_tags(trim($string));

		// return with no change if string is shorter than $limit
		if (strlen($string) <= $limit)
			return $string;

		return substr($string, 0, $limit);
	}
}

if (!function_exists('only_numbers')) {
	function only_numbers($value)
	{
		return preg_replace('/[^0-9]/', '', $value);
	}
}

if (!function_exists('mask')) {
	function mask($val, $mask)
	{
		$val = strval($val);
		$masked = '';
		$k = 0;
		for ($i = 0; $i <= strlen($mask) - 1; $i++) {
			if ($mask[$i] == '#') {
				if (isset($val[$k]))
					$masked .= $val[$k++];
			} else {
				if (isset($mask[$i]))
					$masked .= $mask[$i];
			}
		}
		return $masked;
	}
}

if (!function_exists('dollar_to_real')) {
	function dollar_to_real($value, $places = 2)
	{
	    return number_format($value, $places === null ? 2 : $places, ',', '.');
	}
}

if (!function_exists('dollarToRealTruncated')) {
	function dollarToRealTruncated($value)
	{
		return str_replace([',', '.'], ['', ','], floatval($value));
	}
}

if (!function_exists('real_to_dollar')) {
	function real_to_dollar($value)
	{
		$source = ['.', ','];
		$replace = ['', '.'];
		return str_replace($source, $replace, $value); //remove os pontos e substitui a virgula pelo ponto
	}
}

if (!function_exists('realizeFloat')) {
	function realizeFloat($array)
	{
	    $array = json_decode(json_encode($array), true);
	    foreach($array as $key => $value){
	        if (is_numeric($value) && str_contains($value,'.')) {
	            $array[$key] = dollar_to_real($value);
            }
        }
	    return (object) $array;
	}
}

if (!function_exists('filterKeyWords')) {
	function filterKeyWords($string)
    {
        $expressao = strip_tags ($string);

        $palavrasSemPreposicao = str_ireplace ([" de ", " da ", " do ", " na ", " no ", " em ", " a ", " o ", " e ", " as ", " os "], " ", $expressao);

        return explode (" ", $palavrasSemPreposicao);
    }
}


if (!function_exists('lista_meses')) {
	function lista_meses()
	{
		return [
			1 => 'Janeiro',
			2 => 'Fevereiro',
			3 => 'Março',
			4 => 'Abril',
			5 => 'Maio',
			6 => 'Junho',
			7 => 'Julho',
			8 => 'Agosto',
			9 => 'Setembro',
			10 => 'Outubro',
			11 => 'Novembro',
			12 => 'Dezembro'
		];
	}
}

if (!function_exists('dias_semana')) {
	function dias_semana()
	{
		return [
			0 => 'Segunda-feira',
			1 => 'Terça-feira',
			2 => 'Quarta-feira',
			3 => 'Quinta-feira',
			4 => 'Sexta-feira',
			5 => 'Sábado',
			6 => 'Domingo',
		];
	}
}

if (!function_exists('mb_str_pad')) {
	function mb_str_pad($input, $pad_length, $pad_string = ' ', $pad_type = STR_PAD_RIGHT)
	{
		$diff = strlen( $input ) - mb_strlen( $input );

		return str_pad( $input, $pad_length + $diff, $pad_string, $pad_type );
	}
}

if (!function_exists('str_nv_slug')) {
	function str_nv_slug($title, $separator = ' ', $language = 'en')
	{
        $title = $language ? ASCII::to_ascii((string) $title, $language) : $title;

        $flip = $separator === '-' ? '_' : '-';

        $title = preg_replace('!['.preg_quote($flip).']+!u', $separator, $title);

        $title = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', $title);

        $title = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $title);

        return trim($title, $separator);
    }
}

if (!function_exists('str_nv_slug_matricial')) {
	function str_nv_slug_matricial($title, $separator = ' ', $language = 'en')
	{
		$title = $language ? ASCII::to_ascii((string) $title, $language) : $title;

		$title = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $title);

		return trim($title, $separator);
	}
}

if (!function_exists('removeAcentos')) {
    function removeAcentos($str) {
        return strtr(utf8_decode($str), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ&'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUYE');
    }
}


if (!function_exists('capitalize_names')) {
    function capitalize_names($string, $encoding = 'UTF-8')
    {
        /*$word_splitters = [' ', '-', "O’", "L’", "D’", 'St.', 'Mc', "Dall'", "l’", "d’", "a’", "o’"];
        $lowercase_exceptions = ['of', 'den', 'von', 'van', 'der', 'da', 'and', "d’",
            'das', 'do', 'dos', 'the', 'e', 'el', 'und', 'de', 'para', 'com', 'sem', 'ou', 'por', 'o', 'em',
            'à', 'a', 'no', 'na', 'ao'];
        $uppercase_exceptions = ['II', 'III', 'IV', 'VI', 'VII', 'VIII', 'IX', 'ME', 'EIRELI', 'EPP', 'S/A', 'S.A', 'LTDA', 'UF', 'ICMS', 'IPI',
            'ISS','PIS','COFINS'];

        $string = trim($string);

        if ($string != '') {

            $string = mb_strtolower($string, $encoding);
            $string = str_replace("'", "’", $string);

            foreach ($word_splitters as $delimiter) {
                $words = explode($delimiter, $string);
                $newwords = array();

                foreach ($words as $word) {
                    if (in_array(mb_strtoupper($word, $encoding), $uppercase_exceptions))
                        $word = mb_strtoupper($word, $encoding);
                    else
                        if (!in_array($word, $lowercase_exceptions))
                            $word = mb_strtoupper(mb_substr($word, 0, 1), $encoding)
                                . mb_substr($word, 1);

                    $newwords[] = $word;
                }

                if (in_array(mb_strtolower($delimiter, $encoding), $lowercase_exceptions))
                    $delimiter = mb_strtolower($delimiter, $encoding);

                $string = join($delimiter, $newwords);
            }
        }*/

        return $string;
    }
}
