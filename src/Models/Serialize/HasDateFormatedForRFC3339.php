<?php

namespace Nolikein\ApiDerpibooruFacade\Models\Serialize;

trait HasDateFormatedForRFC3339
{
    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format(\DateTime::RFC3339);
    }
}