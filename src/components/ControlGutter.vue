<template>
  <StyledContentBlock>
    <StyledFormBlock>
      <slot></slot>
    </StyledFormBlock>
  </StyledContentBlock>
</template>

<script>
  import styled from 'vue-styled-components';

  const StyledContentBlock = styled('div')`
      display: grid;
      grid-template-rows: 1fr;
      justify-items: center;
    `;

  const StyledFormBlock = styled('div')`
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
    name: 'ControlGutter',

    components: {
      StyledContentBlock,
      StyledFormBlock
    }
  };
</script>