
const handleSubmitForm = e => {
  e.preventDefault();
  submitWithJS();
};

const handleInputField = () => {
  submitWithJS();
};

const submitWithJS = async () => {
  const $form = document.querySelector('.product__form');
  const data = new FormData($form);
  const entries = [...data.entries()];
  console.log('entries:', entries);
  const qs = new URLSearchParams(entries).toString();
  console.log('querystring', qs);
  const url = `index.php?${qs}&json=true`;
  console.log('url', url);

  //als ik deze lijnen weglaat wordt updatelist nie uitgevoerd maar wertk het js submitten wel? // hou ik deze lijnen erbij krij ik error "Unexpected Token < in JSON at Position 0"

  const response = await fetch(url);
  const result = await response.json();
  console.log(result.length);

  //const products = document.querySelector('.product__list');
  updateList(result);


  //pagination verbergen bij te weinig resultaten

  /*
  const $paginationFirst = document.querySelector('.pagination__link-span');
  const $paginationRest = document.querySelector('.pagination__link');
  if (result.length <= 11) {
    $paginationFirst.classList.add('hide');
    $paginationRest.classList.add('hide');
  }
 */

  //tot hier



  window.history.pushState(
    {},
    '',
    `index.php?${qs}`
  );

};


const updateList = products => {
  const $products = document.querySelector('.product__list');
  $products.innerHTML = products.map(product => {
    return `
       <div class="product__single">

        <form method="get" action="index.php?page=list" class="price">
          <input type="hidden" value="list" name="page">
          <input type="hidden" value=${product.product} name="addProduct">

          <button class="add" type="submit" value="list">
            <span class="material-icons">
              post_add
            </span>
          </button>

        </form>


        <p class="product__name">${product.product}</p>
        <p class="product__price">${product.price}</p>
      </div>
      `;
  }).join(``);
};


export const init = () => {
  console.log('start executing this JavaScript');

  document.documentElement.classList.add('has-js');

  document.querySelectorAll('.searchbar').forEach($field => $field.addEventListener('input', handleInputField));
  document.querySelector('.product__form').addEventListener('submit', handleSubmitForm);
  //countKids();

};

