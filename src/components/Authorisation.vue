<template>
  <ControlGutter>
    <div>
      <BootstrapImage
          :src="require('@/assets/img/avatar.jpg')"
          width="85"
          height="85"
          rounded="circle"
      />
    </div>
    <div>
      User name :
      <BootstrapInput
          v-model="formData.userName"
          name="form_user_name"
          v-validate="'required'"
      />
      <span v-show="errors.has('form_user_name')" style="color: red;">
          The field is required<br>
        </span>
      Password :
      <BootstrapInput
          v-model="formData.password"
          name="form_password"
          type="password"
          v-validate="'min:6|required'"
      />
      <span v-show="errors.has('form_password')" style="color: red;">
          Password less than 6 characters<br>
        </span>
    </div>
    <div>
      <BootstrapButton variant="success" @click="authUser">
        Authorisation
      </BootstrapButton>
    </div>
  </ControlGutter>
</template>

<script>
  import BootstrapImage from 'bootstrap-vue/es/components/image/img';
  import BootstrapInput from 'bootstrap-vue/es/components/form-input/form-input';
  import BootstrapButton from 'bootstrap-vue/es/components/button/button';
  import ControlGutter from './ControlGutter';

  export default {
    name: 'Authorisation',

    components: {
      BootstrapImage,
      BootstrapInput,
      BootstrapButton,
      ControlGutter
    },

    data () {
      return {
        authorize: false,

        formData: {
          name: '',
          email: '',
          userName: '',
          password: ''
        }
      };
    },

    methods: {
      validateForm (toastrType = 'error', toastrMessage = 'Please, enter the fields') {
        return this.$validator.validateAll()
        .then(result => {
          if (!result) {
            this.$toastr(toastrType, toastrMessage, 'Error');
            return false;
          }

          return true;
        });
      },

      authUser () {
        this.validateForm()
        .then((isFormValid) => {
          if (!isFormValid) {
            return;
          }

          const userData = {
            form_data: {
              user_name: this.formData.userName,
              password: this.formData.password
            }
          };

          this.axios({
            method: 'get',
            url: 'http://todo.local/api/server.php',
            params: Object.assign(userData, { auth_user: true })
          })
          .then((serverResponse) => {
            const response = serverResponse.data;

            console.log('auth response ', response);

            // if (response.errors.length !== 0 && response.errors.includes('email')) {
            //   this.$toastr('error', 'User with this email is already exists', 'Error');
            //   return;
            // }

            // TODO add congratulated modal
          });
        });
      }
    }
  };
</script>