p) {
                if (\in_array($group, $this->groups)) {
                    return true;
                }
            }

            return false;
        }

        if (!empty($this->excludeGroups)) {
            foreach ($test->getGroups() as $group) {
                if (\in_array($group, $this->excludeGroups)) {
                    return false;
                }
            }

            return true;
        }

        return true;
    }
}
                                                                                                                                                                                                                            