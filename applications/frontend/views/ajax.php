<?php
        require_once 'Paginator.class.php';

        $conn       = new mysqli( '127.0.0.1', 'root', 'password', 'ci_bootstrap' );

        $limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 1;
        $page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
        $links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;
            $query = "SELECT pid,noplate,intime,outtime,hours,charges,status,typeid,id,confirm,status from park where status = 0 order by id asc";

        $Paginator  = new Paginator( $conn, $query );

        $results    = $Paginator->getData( $page, $limit );

    ?>