/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/*require('./bootstrap');*/

Vue.component('bugger', {
    props: ['error', 'message', 'icon', 'date', 'link'],
    template: `
      <a class="panel-block error">
           <div class="level">
               <div class="level-left">
                   <div class="level-item">
                       <strong>
                           <span class="panel-icon" id="icon"><i class="fa fa-warning"></i></span>
                           {{ error }}
                       </strong>
                   </div>
                   <div class="level-item">
                       {{ message }}
                   </div>
               </div>
               <div class="level-right">
                   <div class="level-item">
                       {{ date }}
                   </div>
              </div>
          </div>
      </a>`
});

Vue.component('tabs', {
    template: `<div>
          <div class="tabs">
            <a v-for="tab in tabs" :class="{ 'is-active': tab.isActive }" :href="tab.href" @click="selectTab(tab)">
              {{ tab.name }}
            </a>
          </div>
            <div class="tabs-details">
              <slot></slot>
            </div>
        </div>`,
    data () {
        return {tabs: []};
    },
    created() {
        console.bugger(this.$children);
        this.tabs = this.$children;
    },
    methods: {
        selectTab(selectedTab) {
            this.tabs.forEach(tab => {
                tab.isActive = (tab.href == selectedTab.href);
            });
        }
    }
});

/**
 * Tab components show content when they are selected and hide their content when another tab is selected
 **/
Vue.component('tab', {
    template: `<div v-show="isActive"><slot></slot></div>`,
    props: {
        name: {required: true},
        selected: {default: false}
    },
    data() {
        return {isActive: false};
    },
    computed: {
        href () {
            return '#' + this.name.toLowerCase();
        }
    },
    mounted() {
        console.bugger('mounted ' + this.name);
        this.isActive = this.selected;
    }
});

new Vue({
    el: '#app',

    data: {
        buggers: []
    },

    computed: {
        errors: function () {
            return this.buggers.filter(function (bugger) {
                return bugger.level_name === 'error';
            })
        },
        warnings: function () {
            return this.buggers.filter(function (bugger) {
                return bugger.level_name === 'warning';
            });
        }
    },
    mounted() {
        axios.get('/api/buggers').then(response => this.buggers = response.data);
    }
});
