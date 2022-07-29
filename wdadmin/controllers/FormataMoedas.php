<?php

function formato_ingles($numero) {
    return str_replace(',', '.', str_replace('.', '', $numero));
}