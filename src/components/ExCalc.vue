<template>
    <v-app id="excalc">
        <v-main>
            <v-container class="fill-height" fluid>
                <v-row align="center" justify="center">
                    <v-col cols="12" sm="8" md="4">
                        <v-card class="elevation-12 pb-6">
                            <v-toolbar color="grey lighten-3" dark flat>
                                <v-toolbar-title class="toolbar__title">Калькулятор конвертации валюты</v-toolbar-title>
                                <v-spacer></v-spacer>
                            </v-toolbar>
                             <v-card-text>
                                <v-form
                                    id="form"
                                    @submit="onSubmit"
                                >
                                    <v-text-field
                                        label="Сумма, руб"
                                        placeholder=0
                                        type="text"
                                        inputmode="numeric"
                                        pattern="[0-9]*"
                                        :rules="[rules.amount]"
                                        v-model="form.amount"
                                        @input="calculateAmountCurrency"
                                    >
                                    </v-text-field>
                                    <v-select
                                        label="Валюта для конвертации"
                                        :items="currencies"
                                        item-text="currency"
                                        return-object
                                        v-model="form.currency"
                                        @change="calculateAmountCurrency"
                                    >
                                    </v-select>
                                    <v-text-field
                                        label="Сумма в валюте"
                                        placeholder=0
                                        type="text"
                                        readonly
                                        v-model="form.amountCurrency"

                                    >
                                    </v-text-field>
                                    <v-text-field
                                        label="E-mail"
                                        type="text"
                                        v-model="form.email"
                                        :rules="[rules.required, rules.email]"
                                    >
                                    </v-text-field>
                                </v-form>
                            </v-card-text>
                            <v-card-actions class="justify-center">
                                <v-btn
                                    color="primary"
                                    type="submit"
                                    form="form"
                                >
                                    Записаться на обмен валюты
                                </v-btn>
                                <a hidden href="https://www.cbr-xml-daily.ru/">Курсы ЦБ РФ в XML и JSON, API</a>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>

import axios from 'axios'
import valuteName from './valuteName.json'

export default {
    name: 'ExCalc',
    data: () => ({
        form: {
            amount: null,
            currency: null,
            amountCurrency: null,
            email: null,
        },
        currencies: [],
        /* Описываем правила для валидации полей*/
        rules: {
            amount: value => {
                const pattern = /^[\d.,]*$/
                return pattern.test(value) || 'Введите число'
            },
            required: value => !!value || 'Укажите e-mail',
            email: value => {
                const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                return pattern.test(value) || 'Некорректный e-mail'
            },
        }
    }),

    created() {
        /* Загружаем данные с курсами валют и добавляем в селект*/
        axios.get('https://www.cbr-xml-daily.ru/daily_json.js')
            .then((response) => {
                const valutes = Object.values(response.data.Valute)

                for (let item of valutes) {
                    let valute = {}
                    valute.currency = valuteName[item.CharCode] ? valuteName[item.CharCode] : item.Name;
                    valute.rate =  item.Nominal / item.Value
                    this.currencies.push(valute)
                }
            }
        )
    },

    methods: {
        /* Описываем функцию для формулу расчета курса*/
        calculateAmountCurrency() {
            /* Преобразуем введеную сумму из строки в число*/
            const amount = parseFloat(this.form.amount);
            /* Преобразуем выбранный курс валюты из строки в число, если валюта выбрана*/
            const rate = this.form.currency && parseFloat(this.form.currency.rate);
            /* Если и сумма, и курс это числа, то выводим произведение, иначе ничего не выводим*/
            this.form.amountCurrency = (amount && rate) ? (amount * rate).toFixed(2) : ''
            return (amount && rate) ? (amount * rate).toFixed(2) : '';
        },
        onSubmit(e) {
            e.preventDefault();
        }
    }
}

</script>

<style>
    #excalc {
        background: linear-gradient(#1976d2, #fff);
    }

    .toolbar__title {
        color: #1976d2;
    }
</style>
