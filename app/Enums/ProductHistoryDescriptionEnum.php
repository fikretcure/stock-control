<?php

namespace App\Enums;

enum ProductHistoryDescriptionEnum: int
{
    case URUN_EKLENDI = 1;

    //
    case URUN_URETIMDE_HARCANDI = 2;
    case URUN_DEFO = 3;

    case GERI_DONUSUMDEN_URUN_EKLENDI = 4;

}
