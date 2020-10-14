<?php

function redirect($toRoute) {
    header('location: ' . URL_ROOT . $toRoute);
}