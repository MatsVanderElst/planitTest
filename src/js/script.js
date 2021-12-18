
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



  const response = await fetch(url);
  const result = await response.json();
  console.log(result.length);


  updateList(result);



  window.history.pushState(
    {},
    '',
    `index.php?${qs}`
  );

};


const updateList = products => {
  const $products = document.querySelector('.product__list');
  console.log($products);
  $products.innerHTML = products.map(product => {

    if (product.discount_price != null) {
      return `
       <div class="product__single">

        <form method="get" action="index.php?page=list" class="price">
          <input type="hidden" value="list" name="page">
          <input type="hidden" value=${product.id} name="addProduct">

          <button class="add" type="submit" value="list">
            <span class="material-icons">
              post_add
            </span>
          </button>

        </form>


        <p class="product__name">${product.product}</p>
        <p class="product__price dicountColor">${product.discountStorePrice.toFixed(2)}</p>
      </div>
      `;
    } else {
      console.log(product.price);
      return `
       <div class="product__single">

        <form method="get" action="index.php?page=list" class="price">
          <input type="hidden" value="list" name="page">
          <input type="hidden" value=${product.id} name="addProduct">

          <button class="add" type="submit" value="list">
            <span class="material-icons">
              post_add
            </span>
          </button>

        </form>


        <p class="product__name">${product.product}</p>
        <p class="product__price">${product.storePrice.toFixed(2)}</p>
      </div>
      `;
    }


  }).join(``);
  console.log($products);
};



export const init = () => {
  console.log('start executing this JavaScript');

  document.documentElement.classList.add('has-js');

  document.querySelectorAll('.searchbar').forEach($field => $field.addEventListener('input', handleInputField));
  document.querySelector('.product__form').addEventListener('submit', handleSubmitForm);


};

