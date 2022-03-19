<?php

function mhmmdq_gateway_post_view( $path , $data = [] )
{
    extract($data);
    include QPGWT_BASEPATH . 'templates/' . str_replace( '.', '/', $path ) . '.php';
}