export const translations = {
    methods: {
        __(key, replacements = {}){
           let translations = typeof window !== "undefined" ? window._translations[key] || key : [];
           Object.keys(replacements).forEach(r => {
               translations = translations.replace(`:${r}`, replacements[r]);
           })
           return translations;
        }
    }
}
