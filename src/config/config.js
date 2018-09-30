import RuTranslation from '../translation/translation.ru';
import EnTranslation from '../translation/translation.en';

export const i18nConfig = {
  locale: 'en', // ru
  messages: {
    en: EnTranslation,
    ru: RuTranslation
  }
};

export const toastrConfig = {
  defaultPosition: 'toast-top-right',
  defaultType: 'info',
  defaultTimeout: 2500
};
