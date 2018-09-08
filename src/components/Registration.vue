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
                Login : <BootstrapInput v-model="formData.login" />
                Password : <BootstrapInput v-model="formData.password" />
            </div>
            <div>
                <BootstrapButton variant="success">
                    Registration
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
    import BootstrapModal from 'bootstrap-vue/es/directives/modal/modal';

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
        name: 'Registration',

        components: {
            StyledRegistrationBlock,
            StyledContentBlock,
            BootstrapImage,
            BootstrapInput,
            BootstrapButton,
            BootstrapModal
        },

        data () {
            return {
                authorize: false,

                formData: {
                    login: '',
                    password: ''
                }
            };
        },

        methods: {
            registrationRequest () {

            }
        }
    }
</script>

<style scoped>
    .content {

    }
</style>