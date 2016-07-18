<?php

namespace Ftl\DB;

class MySqlConnection extends Connection
{

    protected function __construct($connName = 'dev')
    {
        parent::__construct(DriverOptions::MYSQLDRV, $connName);
    }

    protected function init() {;}
}
