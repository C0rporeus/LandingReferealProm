const constraints = {
  tiktok: {
    presence: { allowEmpty: false },
  },
  email: {
    presence: { allowEmpty: false },
    email: true,
  },
};

const form = document.getElementById("contact-form");

form.addEventListener(
  "submit",
  function (event) {
    const formValues = {
      tiktok: form.elements.tiktok.value,
      email: form.elements.email.value,
    };

    const errors = validate(formValues, constraints);

    if (errors) {
      event.preventDefault();
      const errorMessage = Object.values(errors)
        .map(function (fieldValues) {
          return fieldValues.join(", ");
        })
        .join("\n");

      alert(errorMessage);
    }
  },
  false
);
