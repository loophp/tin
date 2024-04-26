# TAX IDENTIFICATION NUMBERS (TINs) - Country Sheet: Spain (ES)

**References:**
- [Spain-TIN.pdf on OECD](https://www.oecd.org/tax/automatic-exchange/crs-implementation-and-assistance/tax-identification-numbers/Spain-TIN.pdf)
- [BOE-A-2008-3580](https://www.boe.es/eli/es/o/2008/02/20/eha451/con#a3)
- [Calculation of the DNI/NIE check digit](https://www.interior.gob.es/opencms/es/servicios-al-ciudadano/tramites-y-gestiones/dni/calculo-del-digito-de-control-del-nif-nie/)

# Table of contents
- [Section I – TIN Description](#section-i--tin-description)
- [Section II – TIN Structure](#section-ii--tin-structure)
  - [Natural Persons with DNI¹ or NIE²](#natural-persons-with-dni-or-nie)
  - [Natural Persons without DNI¹ or NIE²](#natural-persons-without-dni-or-nie)
  - [Non-Natural Persons](#non-natural-persons)
- [Section III – Calculation of the TIN check digit](#section-iii--calculation-of-the-tin-check-digit)
  - [Natural Persons with DNI or NIE](#natural-persons-with-dni-or-nie-1)
  - [Natural Persons without DNI or NIE and Non-Natural Persons](#natural-persons-without-dni-or-nie-and-non-natural-persons)

## Section I – TIN Description

Spain issues TINs, which are reported on official documents of identification.

TIN in Spain is **unique** for tax and customs purposes and contains **nine characters, the last of them is a letter for control (Natural persons) or a control character (Non - natural persons)**.

**Natural persons of Spanish nationality:** Generally, the TIN is the number on your National Identity Card, issued by the Ministry of Internal Affairs (General Directorate of Police). The Tax Administration will provide Spanish natural persons who are not obliged to possess a National Identity Card (DNI) with a Tax Identification Number (TIN) starting with an L (non-resident Spaniards) or a K (resident Spaniards under the age of 14 years), upon request.

**Natural persons without Spanish nationality:** Generally, their Tax Identification Number (TIN) is the Foreigners’ Identification Number (NIE), likewise issued by the Ministry of Internal Affairs. Natural persons without Spanish nationality who do not possess a Foreigners’ Identification Number (NIE) but need a Tax Identification Number (TIN) because they are going to engage in transactions involving Spanish taxation can obtain a Tax Identification Number starting with the letter M, that will have a
transitory nature, until they obtain a Foreigners’ Identification Number (NIE), where appropriate, also issued by the Tax Administration.

Concerning the **entities**, they are obliged to obtain a TIN, which is issued by the Tax Administration

[TOC](#table-of-contents)

## Section II – TIN Structure

### Natural Persons with DNI¹ or NIE²
1. **DNI** = Documento Nacional de Identidad (National Identity Card)
2. **NIE** = Número de Identificación de Extranjero (Foreigners’ Identification Number)

|   Format  |               Explanation              |                      Comments                      |
|---------- |----------------------------------------|----------------------------------------------------|
| 99999999C | 8 digits + 1 Control letter            | Spanish Natural Persons: [DNI¹](#note-1)           |
| X9999999C | Letter X + 7 digits + 1 Control letter | Foreigners with [NIE²](#note-2)                    |
| Y9999999C | Letter Y + 7 digits + 1 Control letter | Foreigners with [NIE²](#note-2)                    |
| Z9999999C | Letter Z + 7 digits + 1 Control letter | Foreigners with [NIE²](#note-2)                    |

[TOC](#table-of-contents)

### Natural Persons without DNI¹ or NIE²
1. **DNI** = Documento Nacional de Identidad (National Identity Card)
2. **NIE** = Número de Identificación de Extranjero (Foreigners’ Identification Number)

|   Format  |               Explanation              |                      Comments                      |
|---------- |----------------------------------------|----------------------------------------------------|
| K9999999C | Letter K + 7 digits + 1 Control letter | Resident Spaniards under 14 without [DNI¹](#note-1)|
| L9999999C | Letter L + 7 digits + 1 Control letter | Non-resident Spaniards without [DNI¹](#note-1)     |
| M9999999C | Letter M + 7 digits + 1 Control letter | Foreigners without [NIE²](#note-2)                 |

[TOC](#table-of-contents)

### Non-Natural Persons

|   Format  | Explanation | Comments |
|-----------|-------------|----------|
| L9999999C | Initial Letter + 7 digits + 1 Control character | The first letter reports on legal form ([BOE-A-2008-3580](https://www.boe.es/eli/es/o/2008/02/20/eha451/con#a3)) |

For entities, the tax identification number will begin with a letter, which will include information about its legal form according to the following keys:

| Letter | Spanish | English |
|---|-|-|
| A | Sociedades anónimas | Public limited companies |
| B | Sociedades de responsabilidad limitada | Limited liability companies |
| C | Sociedades colectivas | Collective societies |
| D | Sociedades comanditarias | Limited partnerships |
| E | Comunidades de bienes, herencias yacentes y demás entidades carentes de personalidad jurídica no incluidas expresamente en otras claves | Communities of property, existing inheritances and other entities lacking legal personality not expressly included in other keys |
| F | Sociedades cooperativas | Cooperative societies |
| G | Asociaciones | Associations |
| H | Comunidades de propietarios en régimen de propiedad horizontal | Communities of owners under horizontal property regime |
| J | Sociedades civiles | Civil societies |
| P | Corporaciones Locales | Local Corporations |
| Q | Organismos públicos | Public organizations |
| R | Congregaciones e instituciones religiosas | Congregations and religious institutions |
| S | Órganos de la Administración del Estado y de las Comunidades Autónomas | Bodies of the Administration of the State and the Autonomous Communities |
| U | Uniones Temporales de Empresas | Temporary Business Unions |
| V | Otros tipos no definidos en el resto de claves | Other types not defined in the rest of the keys |
| N | Entidad extranjera | Foreign entity |
| W | Establecimiento permanente de entidad no residente en territorio español | Permanent establishment of a non-resident in Spain |

[TOC](#table-of-contents)

## Section III – Calculation of the TIN check digit

### Natural Persons with DNI or NIE
[Reference](https://www.interior.gob.es/opencms/es/servicios-al-ciudadano/tramites-y-gestiones/dni/calculo-del-digito-de-control-del-nif-nie/)

**Cases:**

|   Format  |               Explanation              | Type | Standardization |
|---------- |----------------------------------------|------|-----------------|
| 99999999C | 8 digits + 1 Control letter            |  DNI |   99999999 + C  |
| X9999999C | Letter X + 7 digits + 1 Control letter |  NIE |   09999999 + C  |
| Y9999999C | Letter Y + 7 digits + 1 Control letter |  NIE |   19999999 + C  |
| Z9999999C | Letter Z + 7 digits + 1 Control letter |  NIE |   29999999 + C  |

**For NIEs the first letter is replaced as follow:**
```
X => 0
Y => 1
Z => 2
```

**Examples of standardization of NIEs:**
```
X1234567L => 01234567L
Y1234567X => 11234567X
Z1234567R => 21234567R
```

The number is divided by 23 and the remainder is replaced by a letter that is determined by inspection using the following table:

| Remainder | 0 | 1 | 2 | 3 | 4 | 5 | 6 | 7 | 8 | 9 | 10 | 11 |
|-----------|:-:|:-:|:-:|:-:|:-:|:-:|:-:|:-:|:-:|:-:|:--:|:--:|
| **Letter**| T | R | W | A | G | M | Y | F | P | D |  X |  B |

| Remainder | 12 | 13 | 14 | 15 | 16 | 17 | 18 | 19 | 20 | 21 | 22 |
|-----------|:--:|:--:|:--:|:--:|:--:|:--:|:--:|:--:|:--:|:--:|:--:|
| **Letter**|  N |  J |  Z |  S |  Q |  V |  H |  L |  C |  K |  E |

**Example of calculus:**
1. TIN = **X1234567L**
2. Standardization of NIE: TIN = **01234567L**
3. TinNumber = **01234567**, TinChecksum = **L**
4. TinNumber MODULUS 23 = **01234567 % 23** = **19**
5. **19** is the **L** letter

[TOC](#table-of-contents)

### Natural Persons without DNI or NIE and Non-Natural Persons
[Reference](https://www.juntadeandalucia.es/servicios/madeja/sites/default/files/historico/1.4.0/contenido-libro-pautas-196.html#Validacion_de_NIF_con_tipo_distinto_a_DNI)

**Cases:**
|   Format  |                Explanation                |
|---------- |-------------------------------------------|
| K9999999C | Letter K + 7 digits + 1 Control character |
| L9999999C | Letter L + 7 digits + 1 Control character |
| M9999999C | Letter M + 7 digits + 1 Control character |
| L9999999C | 1 Letter + 7 digits + 1 Control character |

**Method:**
In the case of NIF that are not obtained from the DNI or NIE, the control code is obtained using the 7-digit number, excluding the initial letter and the final letter or digit.
1. The even positions of the 7 central digits are added, that is, the initial letter or the control code are not taken into account. (Sum = A)
2. For each of the digits in the odd positions, the digit is multiplied by 2 and the figures in the result are added, but if the result has a single digit, this figure is simply added. (e.g. if the digit is 6, the result would be 6 x 2 = 12 -> 1 + 2 = 3, but if the digit is 2, the result would be 2 x 2 = 4). (Sum = B)
3. Add the result of the 2 previous steps. (A + B = C)
4. We subtract the last digit of the previous sum (C) from 10, the result of which would be the control code (e.g. if C = 14, the last digit is 4, so we would have 10 - 4 = 6). If the last digit of the sum from the previous step is 0 (e.g. C = 30), no subtraction is performed and 0 is taken as the control code.

If the control code is a number, this would be the result of the last operation. If it is a letter, the following relationship would be used:

| Result  | 1 | 2 | 3 | 4 | 5 | 6 | 7 | 8 | 9 | 0 |
|---------|---|---|---|---|---|---|---|---|---|---|
| Control | A | B | C | D | E | F | G | H | I | J |

**Example of calculus:**
TIN = **M2812345C** => Digits: **2812345**
1. Even positions digits (2**8**1**2**3**4**5): 8 + 2 + 4 = **14**
2. Odd positions digits (**2**8**1**2**3**4**5**):
   **2** * 2 = **4**
   **1** * 2 = **2**
   **3** * 2 = **6**
   **5** * 2 = 10 => 1 + 0 = **1**
   **4** + **2** + **6** + **1** = **13**
3. 14 + 13 = 2**7**
4. 10 - **7** = **3**

Result = 3 => Letter **C**

[TOC](#table-of-contents)