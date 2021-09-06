<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package   block_birthday
 * @copyright 2021 Luiz Guilherme Dall' Acqua <luizguilherme@nte.ufsm.br>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['pluginname']  = 'Aniversariantes do dia';
$string['none']  = 'Não usar';
$string['configbirthday0'] = '<table>
<tr>
<td width="35%">*-firstname-*</td>
<td>Imprime o primeiro nome do usuário;</td>
</tr>

<tr>
<td>*-lastname-*</td>
<td>Imprime o sobrenome do usuário</td>
</tr>

<tr>
<td>*-username-*</td>
<td>Imprime o nome de usuário</td>
</tr>
<tr>
<td>*-email-*</td>
<td>Imprime o endereço de e-mail do usuário</td>
</tr>
<tr>
<td>*-profile-url-*</td>
<td>Imprime a url para o perfil do usuário</td>
</tr>
<tr>
<td>*-picture-*</td>
<td>Imprime a imagem do usuário</td>
</tr>
<tr>
<td>*-picture-size-XXX-*</td>
<td>Define o tamanho da exibição da imagem do usuario, por exemplo: 150px = *-picture-size-150-* </td>
</tr>
<tr>
<td>*-subtitle-*</td>
<td>Imprime o campo listado como subtítulo</td>
</tr>
<tr>
<td>*-years-old-*</td>
<td>Imprime a idade do usuário. Exemplo: 33 Anos.</td>
</tr>
</table><br>';
$string['configbirthday1'] = 'Modelo Padrão';
$string['configbirthday2'] = 'Habilitar';
$string['configbirthday3'] = 'Habilita visualização de bloco';
$string['configbirthday4'] = 'Não';
$string['configbirthday5'] = 'Sim';
$string['configbirthday6'] = 'Título do bloco';
$string['configbirthday7'] = 'Título do bloco';
$string['configbirthday8'] = 'CSS';
$string['configbirthday9'] = 'Aplicar CSS ao bloco';
$string['configbirthday10'] = 'Campo do usuário';
$string['configbirthday11'] = 'Campo personalizado com a data de aniversário';
$string['configbirthday12'] = 'Campo de subtitulo';
$string['configbirthday13'] = 'Campo personalizado com informações de subtitulo';
$string['yearsold'] = "{$a} Anos";