<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class ApiController extends BaseController
{
    const SUCCESS = 200;
    const HTTP_NO_FOUND = 404;
    const UNAUTHORIZED = 401;
    const ABNORMAL_STATUS = 402;
    const INSUFFICIENT_BALANCE = 410;
    const VALIDATION_FAILED = 411;
    const OVER_ATTEMPT = 412;
    const SERVER_ERROR = 500;
    const BAD_REQUEST = 400;


    /**
     * @var
     */
    protected $statusCode = self::SUCCESS;
    /**
     * @var int
     */
    protected $headerCode = self::SUCCESS;

    /**
     * @param string $message
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(self::HTTP_NO_FOUND)->respondWithError($message);
    }

    /**
     * @param $message
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function respondWithError($message)
    {

        return $this->respond([
            'error' => ['message' => $message, 'error_code' => $this->getStatusCode()],
            'status' => 0
        ]);
    }

    /**
     * @param       $data
     * @param array $headers
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->getHeaderCode(), $headers);
    }

    /**
     * @return int
     */
    public function getHeaderCode()
    {
        return $this->headerCode;
    }

    /**
     * @param int $headerCode
     */
    public function setHeaderCode($headerCode)
    {
        $this->headerCode = $headerCode;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param string $message
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function respondSystemError($message = 'System Error!')
    {
        return $this->setStatusCode(self::SERVER_ERROR)->respondWithError($message);
    }

    /**
     * @param string $message
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function respondBadRequest($message = 'Bad Request!')
    {
        return $this->setStatusCode(self::BAD_REQUEST)->respondWithError($message);
    }

    /**
     * @param string $message
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function respondAbnormalStatus($message = 'Abnormal Status!')
    {
        return $this->setStatusCode(self::ABNORMAL_STATUS)->respondWithError($message);
    }

    /**
     * @param string $message
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function respondInsufficientBalance($message = 'Insufficient Balance!')
    {
        return $this->setStatusCode(self::INSUFFICIENT_BALANCE)->respondWithError($message);
    }

    /**
     * @param string $message
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function respondUnauthorized($message = 'Unauthorized!')
    {
        return $this->setStatusCode(self::UNAUTHORIZED)->respondWithError($message);
    }

    /**
     * @param string $message
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function respondOverAttempt($message = 'Over Attempt!')
    {
        return $this->setStatusCode(self::OVER_ATTEMPT)->respondWithError($message);
    }

    /**
     * @param string $message
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function respondValidationFailed($message = 'Validation Failed!')
    {
        return $this->setStatusCode(self::VALIDATION_FAILED)->respondWithError($message);
    }

    public function respondSuccess($data = [])
    {
        $data = array_add($data, 'status', 1);

        return $this->setStatusCode(self::SUCCESS)->respond($data);
    }

    /**
     * @param $validator
     * @return string
     */
    public function formatValidatorMessage($validator)
    {
        $msg_arr = $validator->messages()->toArray();

        $error_msg = '';
        foreach ($msg_arr as $msg) {
            $error_msg .= implode(',', $msg);
        }

        return $error_msg;
    }

    public function requestLog($content, $type = '', $ip = '')
    {
        $filename = storage_path('logs/' . date('Y-m-d') . '_request_log.log');
        $errMsg = "[" . date("d M Y H:i:s", time()) . "] [" . strtoupper($type) . "] " . $content . ' | ' . $ip;
        error_log($errMsg . "\n\n", 3, $filename);
    }
}
