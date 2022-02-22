<template>
    <div class="container">
      <h1>Запрлатный калькулятор</h1>
      <b-form @submit="onCalculate($event)">
        <b-form-input v-model="calcForm.salary" placeholder="Оклад"></b-form-input>
        <b-form-input v-model="calcForm.workedDays" placeholder="Отработанное количество дней"></b-form-input>
        <b-form-group label="Имеется ли налоговый вычет 1 МЗП" label-for="taxDeduction">
          <b-form-checkbox id="taxDeduction" v-model="calcForm.taxDeduction" placeholder="Имеется ли налоговый вычет 1 МЗП"></b-form-checkbox>
        </b-form-group>
        <b-form-input v-model="calcForm.workedDays" placeholder="Календарный год"></b-form-input>
        <b-form-input v-model="calcForm.year" placeholder="Календарный год"></b-form-input>
        <b-form-input v-model="calcForm.month" placeholder="Календарный месяц"></b-form-input>
        <b-form-group label="Является ли сотрудник пенсионером" label-for="pensioner">
          <b-form-checkbox id="pensioner" v-model="calcForm.pensioner" placeholder="Является ли сотрудник пенсионером"></b-form-checkbox>
        </b-form-group>
        <b-form-group label="Является ли сотрудник инвалидом, если да, то какой группы" label-for="disability">
          <b-form-checkbox id="disability" v-model="calcForm.disability" placeholder="Является ли сотрудник инвалидом, если да, то какой группы"></b-form-checkbox>
        </b-form-group>
        <b-form-input v-model="calcForm.disabilityCategory" placeholder="Категория"></b-form-input>
        <b-button type="submit" variant="primary">Рассчитать</b-button>
      </b-form>
      <b-card class="mt-3" header="Результат">
        <pre class="m-0">{{ saveForm }}</pre>
      </b-card>
      <b-button type="submit" variant="success" v-on:click="onSave($event)">Сохранить</b-button>
      </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'Salary',

  data () {
    return {
      saveForm: {},
      calcForm: {
        salary: 600000,
        workedDays: 22,
        taxDeduction: true,
        year: 2022,
        month: 2,
        pensioner: false,
        disability: true,
        disabilityCategory: 1

      }
    }
  },
  methods: {
    onCalculate (e) {
      e.preventDefault()
      axios.post('/salary/calculate', this.calcForm).then((res) => {
        console.log(res)
        this.saveForm = res.data
      })
    },
    onSave (e) {
      e.preventDefault()
      axios.post('/salary/calculate/save', this.saveForm).then((res) => {
        console.log(res)
      })
    }
  }
}
</script>

<style scoped>
</style>
