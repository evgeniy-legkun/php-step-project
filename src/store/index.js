import Vue from 'vue';
import Vuex from 'vuex';
import moment from 'moment';

Vue.use(Vuex);

const state = {
  now: moment()
};

const actions = {
  start ({ commit }) {
    setInterval(() => {
      commit('UPDATE_DATE_NOW');
    }, 1000);
  }
};

const getters = {
  now: state => state.now
};

const mutations = {
  UPDATE_DATE_NOW (state) {
    state.now = moment();
  }
};

export default new Vuex.Store({
  state,
  mutations,
  actions,
  getters
});

