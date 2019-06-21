<?php

namespace TheBugSoftware\StareTva;

use TheBugSoftware\StareTva\Services\Request;
use TheBugSoftware\StareTva\Services\Validate;
use TheBugSoftware\StareTva\Traits\FormatResponse;
use TheBugSoftware\StareTva\Exceptions\CuiLimitException;
use TheBugSoftware\StareTva\Exceptions\ValidateException;

/**
 * StareTva class.
 */
class StareTva
{
    use FormatResponse;

    /**
     * @var array
     */
    public $cuis = [];

    /**
     * @var int
     */
    protected $limit = 499;

    /**
     * @var Validate
     */
    private $validate;

    /**
     * @var Request
     */
    private $request;

    /**
     * StareTva constructor.
     */
    public function __construct()
    {
        $this->validate = new Validate();
        $this->request = new Request();
    }

    /**
     * Push data to array collection.
     *
     * @param mixed  $cui
     * @param string $date
     *
     * @return StareTva
     * @throws \TheBugSoftware\StareTva\Exceptions\ValidateException
     */
    public function for($cui, $date = null): self
    {
        if ($this->validate->cui($cui)) {
            $this->cuis[] = [
                'cui'  => $cui,
                'data' => $date ?? date('Y-m-d'),
            ];
        }

        return $this;
    }

    /**
     * Get results from API.
     *
     * @return string
     * @throws \TheBugSoftware\StareTva\Exceptions\CuiLimitException
     * @throws \TheBugSoftware\StareTva\Exceptions\ResponseException
     * @throws \TheBugSoftware\StareTva\Exceptions\ValidateException
     */
    public function get(): string
    {
        if (empty($this->cuis)) {
            throw new ValidateException('At least one CUI number is required.');
        }

        if (count($this->cuis) > $this->limit) {
            throw new CuiLimitException('You have exceeded the maximum CUI\'s limit (500) per request.');
        }

        return $this->response($this->request->get($this->cuis));
    }
}
