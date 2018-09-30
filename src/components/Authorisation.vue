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
      {{ $t('global_buttons.email') }} :
      <BootstrapInput
          v-model="formData.email"
          name="form_email"
          v-validate="'email|required'"
      />
      <span v-show="errors.has('form_email')" style="color: red;">
          Email is not valid<br>
        </span>
      {{ $t('global_buttons.password') }} :
      <BootstrapInput
          v-model="formData.password"
          name="form_password"
          type="password"
          v-validate="'min:6|required'"
      />
      <span v-show="errors.has('form_password')" style="color: red;">
        {{
          $t('validator.min', {
            field: this.$t('global_buttons.password'),
            count: 6
          })
        }}<br>
      </span>
    </div>
    <div>
      <BootstrapButton variant="success" @click="authUser">
        {{ $t('authorisation.authorisation') }}
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
          email: '',
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
              email: this.formData.email,
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

            if (response.errors.length !== 0 && response.errors.includes('email')) {
              this.$toastr('error', 'User with this email is not exists', 'Error');
              return;
            }

            if (response.errors.length !== 0 && response.errors.includes('password')) {
              this.$toastr('error', 'Password is not correct', 'Error');
              return;
            }

            this.$toastr('success', 'You authorised successfully', 'Success');
          });
        });
      }
    }
  };
</script>