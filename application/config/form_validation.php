<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
        'Dogovor' => array(
                array(
                        'field' => 'Num_Dogovor',
                        'label' => 'Номер договора',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'Date_Dogovor',
                        'label' => 'Дата договора',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'Diskont_Dogovor',
                        'label' => 'Дисконт',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'Date_Diskont_Dogovor',
                        'label' => 'Дата дисконта',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'Internat_Card_Dogovor',
                        'label' => 'Международные карты',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'Debet_Card_Dogovor',
                        'label' => 'Дебетовые карты',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'Thank_Dogovor',
                        'label' => 'Спасибо',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'Money_Movement_Dogovor',
                        'label' => 'Оборот',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'Money_Income_Dogovor',
                        'label' => 'Доход',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'ID_Type_Thank_Status',
                        'label' => 'Статус спасибо',
                        'rules' => 'required'
                )
        ),
        'Org' => array(
                array(
                        'field' => 'Name_Org',
                        'label' => 'Название организации',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'INN_Org',
                        'label' => 'ИНН',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'FIO_Boss_Org',
                        'label' => 'ФИО руководителя',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'E_Mail_Org',
                        'label' => 'E-mail',
                        'rules' => 'required|valid_email'
                ),
                array(
                        'field' => 'Phone_Boss_Org',
                        'label' => 'Телефон',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'ID_Type_Org',
                        'label' => 'Тип организации',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'ID_Users',
                        'label' => 'МПР',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'ID_Type_Rank_Org',
                        'label' => 'Должность руководителя',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'Home_Juristical_Address_Org',
                        'label' => 'Юр. адрес',
                        'rules' => 'required|valid_address_j'
                ),
                array(
                        'field' => 'Home_Post_Address_Org',
                        'label' => 'Почтовый адрес',
                        'rules' => 'required|valid_address_p'
                )

        ),
        'TCT' => array(
                array(
                        'field' => 'Name_TCT',
                        'label' => 'Название ТСТ',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'Phone_TCT',
                        'label' => 'Телефон',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'Num_Merchant_TCT',
                        'label' => 'Номер мерчанта',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'ID_Type_MCC_TCT',
                        'label' => 'МСС',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'Kind_Activity',
                        'label' => 'Вид деятельности',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'Contact_Name_TCT',
                        'label' => 'Контактное лицо',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'ID_Type_Kategoria_TCT',
                        'label' => 'Категория ТСТ',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'Mode_TCT',
                        'label' => 'Режим работы',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'Position_Contact_TCT',
                        'label' => 'Должность',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'Date_Visit_MPR_TCT',
                        'label' => 'Дата посещения МПР',
                        'rules' => 'valid_date'
                ),
                array(
                        'field' => 'Date_Implementation_Potok_TCT',
                        'label' => 'Дата внедрения потока',
                        'rules' => 'valid_date'
                ),
                array(
                        'field' => 'ID_Type_Status_Tct',
                        'label' => 'Статус ТСТ',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'Home_Address_TCT',
                        'label' => 'Почтовый адрес',
                        'rules' => 'required|valid_address_p'
                )
        ),
        'TID' => array(
                array(
                        'field' => 'Num_TID',
                        'label' => 'TID',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'Kod_TID',
                        'label' => 'Код активации',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'Date_Sending_Request_TID',
                        'label' => 'Дата подачи заявки',
                        'rules' => 'valid_date'
                ),
                array(
                        'field' => 'Date_Installation_Terminal_TID',
                        'label' => 'Дата установки терминала',
                        'rules' => 'valid_date'
                ),
                array(
                        'field' => 'Date_Dismantling_TID',
                        'label' => 'Дата демонтажа',
                        'rules' => 'valid_date'
                ),
                array(
                        'field' => 'Date_Reg_CA_TID',
                        'label' => 'Дата регистрации ЦА',
                        'rules' => 'valid_date'
                )
        ),
        'Terminal' => array(
                array(
                        'field' => 'ID_Type_Terminal',
                        'label' => 'Модель терминала',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'SN_Num_Terminal',
                        'label' => 'Серийный номер',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'Inv_Num_Terminal',
                        'label' => 'Инвентарный номер',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'Price_Terminal',
                        'label' => 'Стоимость',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'ID_Type_Status_Terminal',
                        'label' => 'Статус',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'Date_Terminal',
                        'label' => 'Дата поступления',
                        'rules' => 'valid_date'
                )
        ),
        'Pinpad' => array(
                array(
                        'field' => 'ID_Type_PinPad',
                        'label' => 'Модель',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'SN_Num_PinPad',
                        'label' => 'Серийный номер',
                        'rules' => 'required'
                )
        ),
        'Sim' => array(
                array(
                        'field' => 'ID_Type_Operator_SIM',
                        'label' => 'Оператор',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'SN_Num_SIM',
                        'label' => 'Серийный номер',
                        'rules' => 'required'
                )
        ),
        'FilterID' => array(
                array(
                        'field' => 'search',
                        'label' => 'ID',
                        'rules' => 'required|integer'
                ),
                array(
                        'field' => 'searchfild',
                        'label' => 'Поля поиска',
                        'rules' => 'required|valid_fild'
                )
        ),
        'FilterArr' => array(
                array(
                        'field' => 'search',
                        'label' => 'ID',
                        'rules' => 'required|integer'
                ),
                array(
                        'field' => 'searchfild',
                        'label' => 'Поля поиска',
                        'rules' => 'required|valid_fild'
                )
        )
);

$config['error_prefix'] = '<span class="label label-important">';
$config['error_suffix'] = '</span>';