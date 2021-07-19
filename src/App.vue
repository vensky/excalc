<template>
    <div id="app">
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
                              <!--       <v-card-text>
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
                                    </v-card-text> -->
                                    <v-card-actions class="justify-center">
                                        <v-btn
                                            color="primary"
                                            type="submit"
                                            form="form"
                                        >
                                            Записаться на обмен валюты
                                        </v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-main>
            </v-app>
    </div>
</template>

<script>
    export default {
        name: 'app',
        components: {}
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
