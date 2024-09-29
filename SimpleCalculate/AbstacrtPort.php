<?php

namespace Cowglow\SoapCalculator\Infrastructure;

/**
 * Class AbstractPort
 *
 * @package Cowglow\SoapCalculator\Infrastructure
 */
class AbstractPort
{
    /**
     * @var string $wsdl
     */
    protected $wsdl;
    
    /**
     * AbstractPort constructor.
     *
     * @param $wsdl
     */
    public function __construct($wsdl)
    {
        $this->wsdl = $wsdl = 'http://www.dneonline.com/calculator.asmx?WSDL';
    }

    /**
     * Soap Request
     *
     * @param $inputs
     * @param $operator
     *
     * @return string
     */
    public function SoapRequest($inputs, $operator): string
    {
        $soapClient = new \SoapClient($this->wsdl);
        $input = [
            'intA' => $inputs[0],
            'intB' => $inputs[1]
        ];

        switch ($operator) {
            case '+':
                $response = $soapClient->Add($input);
                return $response->AddResult;
            case '-':
                $response = $soapClient->Subtract($input);
                return $response->SubtractResult;
            case '*':
                $response = $soapClient->Multiply($input);
                return $response->MultiplyResult;
            case '/':
                $response = $soapClient->Divide($input);
                return $response->DivideResult;
            default:
                throw new \Exception("Invalid operator.");
        }
    }
}
