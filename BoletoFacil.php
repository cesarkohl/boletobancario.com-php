<?php

namespace BoletoFacil;

/**
 * BoletoFacil
 *
 */
class BoletoFacil
{

    public function __construct()
    {
        $this->token        = false;
        $this->environment  = 'www';
        $this->responseType = 'json';
    }

    /**
     * Set environment
     *
     * @param $environment string (sandbox || www)
     */
    public function setEnvironment($environment)
    {
        $this->environment = $environment;
    }

    /**
     * Get environment
     *
     * @param $environment string
     * @return string
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * Set token
     *
     * @param $token string
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * Get token
     *
     * @param $token string
     * @return bool
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set response type
     *
     * @param $responseType string
     */
    public function setResponseType($responseType)
    {
        $this->responseType = $responseType;
    }

    /**
     * Get responseType
     *
     * @param $responseType string
     * @return bool
     */
    public function getResponseType()
    {
        return $this->responseType;
    }

    /**
     * Issue charge
     * Geração de cobranças
     *
     * documentation: https://sandbox.boletobancario.com/boletofacil/integration/integration.html#cobrancas
     *
     * @param $token (required)
     * @param $description (required)
     * @param string $reference
     * @param $amount (required)
     * @param string $dueDate
     * @param string $installments
     * @param string $maxOverdueDays
     * @param string $fine
     * @param string $interest
     * @param string $discountAmount
     * @param string $discountDays
     * @param $payerName (required)
     * @param $payerCpfCnpj (required)
     * @param string $payerEmail
     * @param string $payerPhone
     * @param string $payerBirthDate
     * @param string $billingAddressStreet
     * @param string $billingAddressNumber
     * @param string $billingAddressComplement
     * @param string $billingAddressCity
     * @param string $billingAddressState
     * @param string $billingAddressPostcode
     * @param string $notifyPayer
     * @param string $notificationUrl
     * @param string $responseType
     * @return mixed
     */
    public function issueCharge($description, $amount, $payerName, $payerCpfCnpj, $reference = '', $dueDate = '', $installments = '', $maxOverdueDays = '', $fine = '', $interest = '', $discountAmount = '', $discountDays = '', $payerEmail = '', $payerPhone = '', $payerBirthDate = '', $billingAddressStreet = '', $billingAddressNumber = '', $billingAddressComplement = '', $billingAddressCity = '', $billingAddressState = '', $billingAddressPostcode = '', $notifyPayer = '', $notificationUrl = '', $responseType = '' )
    {
        $url = 'https://'.$this->environment.'.boletobancario.com/boletofacil/integration/api/v1/issue-charge';

        $data = [
            'token'                     => $this->token,
            'description'               => $description,
            'reference'                 => $reference,
            'amount'                    => $amount,
            'dueDate'                   => $dueDate,
            'installments'              => $installments,
            'maxOverdueDays'            => $maxOverdueDays,
            'fine'                      => $fine,
            'interest'                  => $interest,
            'discountAmount'            => $discountAmount,
            'discountDays'              => $discountDays,
            'payerName'                 => $payerName,
            'payerCpfCnpj'              => $payerCpfCnpj,
            'payerEmail'                => $payerEmail,
            'payerPhone'                => $payerPhone,
            'payerBirthDate'            => $payerBirthDate,
            'billingAddressStreet'      => $billingAddressStreet,
            'billingAddressNumber'      => $billingAddressNumber,
            'billingAddressComplement'  => $billingAddressComplement,
            'billingAddressCity'        => $billingAddressCity,
            'billingAddressState'       => $billingAddressState,
            'billingAddressPostcode'    => $billingAddressPostcode,
            'notifyPayer'               => $notifyPayer,
            'notificationUrl'           => $notificationUrl,
            'responseType'              => $responseType,
        ];

        return $this->response( $this->curl($url, $data) );
    }

    /**
     * Payment Notification
     * Notificação de Pagamentos
     *
     * documentation: https://sandbox.boletobancario.com/boletofacil/integration/integration.html#notificacao
     *
     * @param $paymentToken
     * @param string $responseType
     * @return mixed
     */
    public function queryPaymentDetails($paymentToken, $responseType = '')
    {
        $url = 'https://'.$this->environment.'.boletobancario.com/boletofacil/integration/api/v1/fetch-payment-details';

        $data = [
            'paymentToken' => $paymentToken,
            'responseType' => $responseType
        ];

        return $this->response( $this->curl($url, $data) );

    }

    /**
     * Query Balance
     * Consulta de Saldo
     *
     * documentation: https://sandbox.boletobancario.com/boletofacil/integration/integration.html#saldo
     *
     * @return array|mixed|object
     */
    public function queryBalance()
    {
        $url = 'https://'.$this->environment.'.boletobancario.com/boletofacil/integration/api/v1/fetch-balance';

        $data = [
            'token' => $this->token
        ];

        return $this->response( $this->curl($url, $data) );
    }

    /**
     * Request Transfer
     * Solicitação de Transferência
     *
     * documentation: https://sandbox.boletobancario.com/boletofacil/integration/integration.html#transferencia
     *
     * @param string $amount
     * @param string $responseType
     * @return array|mixed|object
     */
    public function requestTransfer($amount = '', $responseType = '')
    {
        $url = 'https://'.$this->environment.'.boletobancario.com/boletofacil/integration/api/v1/request-transfer';

        $data = [
            'token'        => $this->token,
            'amount'       => $amount,
            'responseType' => $responseType
        ];

        return $this->response( $this->curl($url, $data) );
    }

    /**
     * Cancel charge
     * Cancelar cobrança
     *
     * documentation: https://sandbox.boletobancario.com/boletofacil/integration/integration.html#cancel_charge
     *
     * @return array|mixed|object
     */
    public function cancelCharge($code, $responseType = '')
    {
        $url = 'https://'.$this->environment.'.boletobancario.com/boletofacil/integration/api/v1/cancel-charge';

        $data = [
            'token'        => $this->token,
            'code'         => $code,
            'responseType' => $responseType
        ];

        return $this->response( $this->curl($url, $data) );
    }

    /**
     * cURL
     *
     * @param $url
     * @param $data
     * @return mixed
     */
    public function curl($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_ENCODING, "UTF-8"); // new
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $return = curl_exec($ch);
        curl_close($ch);

        return $return;
    }

    /**
     * Returns request based on response type
     *
     * @param $return
     * @return array|mixed|object
     */
    public function response($return)
    {
        if($this->responseType == 'array') return json_decode($return, true);
        else                               return $return; // == 'json'
    }

}
