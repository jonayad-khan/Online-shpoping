nother
     *
     * @param Carbon $dt
     *
     * @return bool
     */
    public function gte(Carbon $dt)
    {
        return $this >= $dt;
    }

    /**
     * Determines if the instance is greater (after) than or equal to another
     *
     * @param Carbon $dt
     *
     * @see gte()
     *
     * @return bool
     */
    public function greaterThanOrEqualTo(Carbon $dt)
    {
        return $this->gte($dt);
    }

    /**
     * Determines if the instance is less (before) than another
     *
     * @param Carbon $dt
     *
     * @return bool
     */
    public function lt(Carbon $dt)
    {
        return $this < $dt;
    }

    /**
     * Determines if the instance is less (before) than another
     *
     * @param Carbon $dt