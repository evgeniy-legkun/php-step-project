<template>
  <StyledContentBlock>
    <StyledRegistrationBlock>
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
    </StyledRegistrationBlock>
  </StyledContentBlock>
</template>

<script>
  import styled from 'vue-styled-components';
  import BootstrapImage from 'bootstrap-vue/es/components/image/img';
  import BootstrapInput from 'bootstrap-vue/es/components/form-input/form-input';
  import BootstrapButton from 'bootstrap-vue/es/components/button/button';

  const StyledContentBlock = styled('div')`
      display: grid;
      grid-template-rows: 1fr;
      justify-items: center;
    `;

  const StyledRegistrationBlock = styled('div')`
      display: grid;
      grid-template-columns: 1fr;
      grid-template-rows: 1fr 2fr 1fr;
      border-radius: 8px;
      width: 300px;
      border: 1px solid blue;
      grid-row-gap: 25px;
      padding: 15px;
    `;

  export default {
    name: 'Authorisation',

    components: {
      StyledRegistrationBlock,
      StyledContentBlock,
      BootstrapImage,
      BootstrapInput,
      BootstrapButton
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