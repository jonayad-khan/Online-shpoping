 just ignore these unserializable classes, and serialize what
     * we can.
     *
     * @param array $return
     *
     * @return string
     */
    private function serializeReturn(array $return)
    {
        $serializable = array();

        foreach ($return as $key => $value) {
            // No need to return magic variables
            if (Context::isSpecialVariableName($key)) {
                continue;
            }

            // Resources and Closures don't error, but they don't serialize well either.
            if (is_resource($value) || $value instanceof \Closure) {
                continue;
            }

            try {
                @serialize($value);
                $serializable[$key] = $value;
            } catch (\Exception $e) {
     