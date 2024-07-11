<?php

namespace DungNguyenTrung\MesCmd\Constants;

final class Shell
{
    const CONTROLLER = 'mes:controller {name} {folder}';
    const DTO = 'mes:dto {name} {folder} {--model=}';
    const MODEL = 'mes:model {name} {folder}';
    const QUERY = 'mes:query {name} {folder} {--model=}';
    const REPOSITORY = 'mes:repo {name} {folder}';
    const SERVICE = 'mes:service {name} {folder}';
    const VIEW = 'mes:view {name} {folder}';
    const VIEW_MODEL = 'mes:vm {name} {folder} {--model=}';
}
