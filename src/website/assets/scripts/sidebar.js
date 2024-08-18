setInterval(() => getUser(), 1000);

let user = {};
let lastSender = '';
let lastChatID;
let chatToggled = false;
let adminLastMessageID = 1001;
let hasInsertedMessage = true;
let cartVisible = false;
let loginVisible = false;

async function getUser() {
  let response = await fetch('http://backend.has-precast.com', { credentials: 'include' });
  let data = await response.json();

  if (data.email !== 'none' && !cartVisible) {
    user = data;
    user.name = user.name.toUpperCase();

    cartVisible = true;
    loginVisible = false;
    setSidebarView(true);
    toggleCartAndOrders(params.get('toggleOrder'));
  } else if (data.email === 'none' && !loginVisible) {
    loginVisible = true;
    setSidebarView(false);
  }

  if (params.get('toggleChat') && !chatToggled) {
    document.querySelectorAll(`.message-button`)[params.get('toggleChat')].click();
    chatToggled = true;
  }
}

function setSidebarView(setSidebar) {
  const container = document.querySelector('.sidebar-container');

  container.innerHTML =
    `<div class="account-wall">
      <h2>Looks like you do not<br>have an account yet...</h2>
      <a href="/signup"><button>Sign up</button></a>
      <a href="/login"><button>Log in</button></a>
    </div>`;

  if (setSidebar) {
    container.innerHTML =
      `<div class="contents">
          <div class="heading">
            <h2>Welcome, ${user.name}</h2>
            </div> 
            <div class="buttons">
            <div>
              <button class="tab toggle-cart">Cart</button>
              <button class="tab toggle-orders">Orders</button>
            </div>
            <button class="tab logout">Logout</button>
          </div>
          <div class="cart">
            <div class="cart-actions">
              <button style="--content: 'add to cart'" class="add"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z"/></svg></button>
              <button style="--content: 'remove to cart'" class="remove"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M5 13v-2h14v2z"/></svg></button>
              <button style="--content: 'create an order'" class="create-order"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M5.586 4.586C5 5.172 5 6.114 5 8v9c0 1.886 0 2.828.586 3.414C6.172 21 7.114 21 9 21h6c1.886 0 2.828 0 3.414-.586C19 19.828 19 18.886 19 17V8c0-1.886 0-2.828-.586-3.414C17.828 4 16.886 4 15 4H9c-1.886 0-2.828 0-3.414.586M9 8a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2zm0 4a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2z" clip-rule="evenodd"/></svg></button>
            </div>
            <div class="cart-contents"></div>
          </div>
          <div class="orders">
            <div class="order-contents"></div>
          </div>
      </div>`;

    const logout = document.querySelector('.logout');
    logout.addEventListener('click', async () => {
      let response = await fetch('http://backend.has-precast.com/logout', { credentials: 'include' });
      if (response) location = location + `?message=${encodeURI('Successfully logged out')}&top=5&type=success`;
    });

    createCartItems();
    setupCart();
    setupOrder();
  }
}

async function setupOrder() {
  const orders = await createOrders();
  const orderContents = getElement('.order-contents');

  console.log(orders);
  if (Object.keys(orders).length) {
    for (const [key, values] of Object.entries(orders)) {
      let orderList = '';

      for (const order of values.orders) {
        orderList = `
          <details class="order-item" data-order-id=${order.id} open>
            <summary>
              <h3>${order.design_name}</h3>
            </summary>
            <h3>size: ${order.size}</h3>
            <h3>quantity: ${order.quantity}</h3>
          </details>` + orderList;
      }

      const contract =
        `<div class="contract-container">
          <div>
            <h4>Payment Status: ${values['payment_status']}</h4>
            <h4>Delivery Date: ${!(values['delivery_date'].includes("0000-00-00")) ? new Date(values['delivery_date']).toLocaleDateString() : 'N/A'}</h4>
          </div>
          <button data-id="${key}" id="contract-button-${key}" class="contract-button">Contract</button>
        </div>`;

      orderContents.innerHTML =
        `<div class="order">
            <h2>Billing ${key}</h2>
            <button data-id="${key}" id="message-button-${key}" class="message-button">Message</button>
            ${(values.quotation) ? contract : ''}
            <div class="order-info">
              <h4>Quotation: ${numFormat((values.quotation) ? values.quotation : 0)}</h4>
              <h4>Billing Status: ${values.status}</h4>
            </div>
            <details open>
              <summary class="orders-heading">
                <h3>Orders</h3>
              </summary>
              ${orderList}
            </details>
          </div>
          <div class="chat toggle-chat" id="chat-${key}">
            <div class="chat-actions">
              <button id="close-chat-${key}" class="close-chat"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z"/></svg></button>
              <h2>Billing ${key}</h2>
            </div>
            <div class="chat-container">
              <div class="chat-box" id="chat-box-${key}"></div>
              <form data-id="${key}" class="chat-form" id="chat-form-${key}">
                <input id="message-${key}" class="message" type="text" name="message">
                <button id="send-button-${key}" class="send-button"><svg xmlns="http://www.w3.org/2000/svg" width="0.94em" height="1em" viewBox="0 0 15 16"><path fill="currentColor" d="M12.49 7.14L3.44 2.27c-.76-.41-1.64.3-1.4 1.13l1.24 4.34q.075.27 0 .54l-1.24 4.34c-.24.83.64 1.54 1.4 1.13l9.05-4.87a.98.98 0 0 0 0-1.72Z"/></svg></button>
              </form>
            </div>
          </div>
          <div data-id="${key}" class="contract-form" id="contract-form-${key}">
            <h1>Contract</h1>
            <form action="http://backend.has-precast.com/submit-payment" method="post">
              <label>Payment Method:</label>
              <select name="payment_method" class="payment-method">
                <option value="BDO">BDO</option> 
                <option value="UNIONBANK">UNIONBANK</option> 
                <option value="GCASH">GCASH</option> 
              </select>
              <h4 class="account-name"></h4>
              <h4 class="account-number"></h4>
              <div class="reference">
                <label>Payment Reference Number:</label>
                <input type="text" name="payment_reference" class="payment-reference">
              </div>
              <div>
                <label>Preferred Delivery Date:</label>
                <input type="date" name="delivery_date" class="delivery-date">
              </div>
              <input type="hidden" name="billing_id" value=${key}>
              <div>
                <button>Submit Payment</button>
                <button type="button" class="close-payment">Close</button>
              </div>
            </form>
          </div>`
        + orderContents.innerHTML;
    }
    addOrderEventListeners();
    getElement('.toggle-orders').click();
    addContractEventListeners();
  }
}

async function getNewMessages(id, chatBox) {
  let getMessages = await fetch('http://backend.has-precast.com/get-new-message', {
    credentials: 'include',
    method: 'POST',
    body: createFormData({ billing_id: id, id: adminLastMessageID })
  });

  const messages = await getMessages.json();

  if (messages.length > 0) {
    for (const message of messages) {
      createMessageFromDB(id, message, false);
    }
    chatBox.scrollTop = chatBox.scrollHeight;
  }
}

async function getMessages(id) {
  let getMessages = await fetch('http://backend.has-precast.com/get-message', {
    credentials: 'include',
    method: 'POST',
    body: createFormData({ billing_id: id })
  });

  const messages = await getMessages.json();

  if (messages) {
    hasInsertedMessage = false;
    console.log(messages);
    for (const message of messages) {
      createMessageFromDB(id, message, false);
    }
  }
  hasInsertedMessage = true;
}

function createMessage(key, message) {
  const chatBox = getElement(`#chat-box-${key}`);

  const chatMessage = document.createElement('div');
  const status = document.createElement('div');

  if (lastSender !== 'CLIENT') {
    const name = document.createElement('div');
    name.innerText = user.name;
    name.style.fontWeight = 'bold';
    name.style.paddingRight = '5px';
    name.classList.add('name', 'anchor-right');

    chatBox.appendChild(name);
    lastSender = 'CLIENT';
  }

  chatMessage.classList.add('chat-message', 'anchor-right');
  (message.includes('"type":"QUOTE"')) ? chatMessage.innerHTML = JSON.parse(message).message : chatMessage.innerText = message;
  chatBox.appendChild(chatMessage);

  if (message.includes('"type":"QUOTE"')) {
    const quoteButtons = [chatMessage.querySelector('.accept-quote'), chatMessage.querySelector('.reject-quote')];
    addQuoteEventListeners(chatMessage, quoteButtons, key);
  }

  status.classList.add('status', 'anchor-right');
  status.innerText = 'sending';
  chatBox.appendChild(status);
  return status;
}

function createMessageFromDB(key, message, sendStatus = true) {
  const chatBox = getElement(`#chat-box-${key}`);

  const chatMessage = document.createElement('div');
  const status = document.createElement('div');
  if (lastSender !== message.sender) {
    const name = document.createElement('div');
    name.innerText = (message.sender !== 'ADMIN') ? user.name : 'ADMIN';
    name.style.fontWeight = 'bold';
    name.classList.add('name', (message.sender === 'ADMIN') ? 'anchor-left' : 'anchor-right');

    if (message.sender === 'ADMIN') name.style.paddingLeft = '5px';
    else name.style.paddingRight = '5px';

    chatBox.appendChild(name);
    lastSender = message.sender;
  }

  if (message.sender === 'ADMIN') adminLastMessageID = message.id;

  let anchor = (message.sender === 'ADMIN') ? 'anchor-left' : 'anchor-right';
  chatMessage.style.backgroundColor = (message.sender === 'ADMIN') ? 'var(--clr-primary-shade)' : 'var(--clr-accent)';
  chatMessage.style.color = (message.sender === 'ADMIN') ? 'var(--clr-secondary)' : 'var(--clr-primary)';
  chatMessage.classList.add('chat-message', anchor);

  (message.message.includes('"type":"QUOTE"')) ? chatMessage.innerHTML = JSON.parse(message.message).message : chatMessage.innerText = message.message;
  chatBox.appendChild(chatMessage);

  if (message.message.includes('"type":"QUOTE"')) {
    const quoteButtons = [chatMessage.querySelector('.accept-quote'), chatMessage.querySelector('.reject-quote')];
    chatMessage.setAttribute('data-id', message.id);
    addQuoteEventListeners(chatMessage, quoteButtons, key);
  }

  if (sendStatus) {
    status.classList.add('status', 'anchor-right');
    status.innerText = 'sending';
    chatBox.appendChild(status);
    return status;
  }
}

function addContractEventListeners() {
  const contractButtons = document.querySelectorAll('.contract-button');
  
  for (let i = 0; i < contractButtons.length; i++) {
    const contractForm = document.querySelector(`#contract-form-${contractButtons[i].dataset.id}`);

    contractButtons[i].addEventListener('click', async () => {
      contractForm.style.display = 'block';

      let paymentMethod = contractForm.querySelector('.payment-method');
      let deliveryDate = contractForm.querySelector('.delivery-date');
      let paymentReference = contractForm.querySelector('.payment-reference');
      let payment = await getPayment(contractButtons[i].dataset.id);

      if (payment && payment['payment_method'] !== null) {
        paymentMethod.value = payment['payment_method'];
        deliveryDate.value = payment['delivery_date'];
        paymentReference.value = payment['payment_reference'];
      }

      let today = new Date();
      let nextWeek = new Date(today.getFullYear(), today.getMonth(), today.getDate() + 7);
      deliveryDate.valueAsDate = nextWeek;
      deliveryDate.setAttribute('min', `${deliveryDate.value}`);

      let paymentMethods = {
        'BDO': { account_name: "H&AS' CONCRETE PRODUCTS MANUFACTURING", account_number: '006770217499' },
        'UNIONBANK': { account_name: "HERSHEY O. CRISOLOGO", account_number: '109660823469' },
        'GCASH': { account_name: "", account_number: '09273891016' },
      }

      paymentMethod.addEventListener('change', (e) => {
        let account = paymentMethods[e.target.value];

        contractForm.querySelector('.account-name').innerText = account['account_name'] ? `Account Name: ${account['account_name']}` : '';
        contractForm.querySelector('.account-number').innerText = `Account Number: ${account['account_number']}`;
      });
      paymentMethod.dispatchEvent(new Event('change'));

      let closeButton = contractForm.querySelector('.close-payment');
      closeButton.addEventListener('click', () => {
        contractForm.style.display = 'none';
      });
    });
  }
}

function addQuoteEventListeners(message, buttons, key) {
  buttons[0].addEventListener('click', async () => {
    buttons[0].disabled = true;
    let quoteInput = message.querySelector('.quote-offer').dataset.quote;
    let quotation = await setQuote(key, quoteInput);

    if (quotation) {
      location = location + `?message=${encodeURI(`Quotation for Billing ${key} has been set. You can now fill up the contract.`)}&top=5&right=5&toggleChat=${lastChatID}&type=success`;
    }
  });

  buttons[1].addEventListener('click', async () => {
    let quoteInput = message.querySelector('.quote-offer').dataset.quote;
    let removed = await removeQuote(key, message.dataset.id, quoteInput);
    location = location + `?message=${encodeURI(`Rejected quotation price of ${quoteInput}.`)}&top=5&right=5&toggleChat=${lastChatID}&type=error`;
  });
}

function addOrderEventListeners() {
  const messageButtons = document.querySelectorAll('.message-button');
  const chats = document.querySelectorAll('.chat');

  for (let i = 0; i < chats.length; i++) {
    const closeButton = chats[i].querySelector('.close-chat');
    const chatForm = chats[i].querySelector(`.chat-form`);
    const chatBox = chats[i].querySelector('.chat-box');

    messageButtons[i].addEventListener('click', async () => {
      lastChatID = i;

      await getMessages(chatForm.dataset.id);
      chats[i].classList.toggle('toggle-chat');
      chatBox.scrollTop = chatBox.scrollHeight;

      const checkNewMessages = setInterval(async () => {
        if (chats[i].classList.contains('toggle-chat')) clearInterval(checkNewMessages);
        else {
          if (hasInsertedMessage) {
            hasInsertedMessage = false;
            await getNewMessages(chatForm.dataset.id, chatBox);
            hasInsertedMessage = true;
          }
        }
      }, 700);
    });

    closeButton.addEventListener('click', () => {
      chats[i].classList.toggle('toggle-chat');
      chatBox.innerHTML = '';
      lastSender = '';
    });

    chatForm.addEventListener('submit', async (e) => {
      e.preventDefault();

      let key = chatForm.dataset.id;
      let message = getElement(`#message-${key}`);
      let isCooldown = false;

      if (!isCooldown && message.value) {
        const chatBox = getElement(`#chat-box-${key}`);

        const text = message.value;
        const status = createMessage(key, text);

        chatBox.scrollTop = chatBox.scrollHeight;
        chatForm.reset();

        const response = await sendMessage(text, key);
        isCooldown = true;

        const checkIfSent = setInterval(() => {
          console.log(response);
          if (response) {
            chatBox.removeChild(status);
            clearInterval(checkIfSent);
          }
        }, 500);

        setTimeout(() => {
          isCooldown = false;
        }, 1000);
      }
    });
  }
}

async function getPayment(billingID) {
  let getPayment = await fetch('http://backend.has-precast.com/get-payment', {
    credentials: 'include',
    method: 'POST',
    body: createFormData({ billing_id: billingID })
  });

  return getPayment.json();
}

async function removeQuote(billingID, id, quotation) {
  let removeQuote = await fetch('http://backend.has-precast.com/remove-quotation', {
    credentials: 'include',
    method: 'POST',
    body: createFormData({ billing_id: billingID, id: id, quotation: quotation })
  });

  return removeQuote.json();
}

async function setQuote(billingID, quotation) {
  let setQuote = await fetch('http://backend.has-precast.com/set-quotation', {
    credentials: 'include',
    method: 'POST',
    body: createFormData({ billing_id: billingID, quotation: quotation })
  });

  return setQuote.json();
}

async function sendMessage(message, id) {
  let sendMessage = await fetch('http://backend.has-precast.com/send-message', {
    credentials: 'include',
    method: 'POST',
    body: createFormData({ billing_id: id, message: message, sender: 'CLIENT' })
  });

  return sendMessage.json();
}

function setupCart() {
  const cartActions = getElement('.cart-actions');
  const cartContents = getElement('.cart-contents');

  const createOrder = getElement('.create-order');
  createOrder.addEventListener('click', async () => {
    const products = document.querySelectorAll('.product-checkbox');
    let checks = false;
    let productList = [];

    for (let i = 0, j = 0; i < products.length; i++) {
      let isPresent = false;
      if (products[i].checked) {
        checks = true;

        productList[j++] = {
          wall_form_block_id: products[i].dataset.wfbId,
          cart_id: products[i].dataset.cartId,
          size: products[i].dataset.wfbSize,
          quantity: products[i].dataset.wfbQuantity,
        };
      }
    }

    if (!checks) {
      location = location + `?message=${encodeURI('Select an item first')}&top=10&right=5&type=error`;
      return;
    }

    let addToOrder = await fetch('http://backend.has-precast.com/add-to-order', {
      credentials: 'include',
      method: 'POST',
      body: createFormData({ order: JSON.stringify(productList) })
    });

    let orderData = await addToOrder.json();
    console.log(orderData);

    if (checks) {
      location = location + `?message=${encodeURI(`Successfully created an order`)}&top=10&right=5&type=success&toggleOrder=true`;
    }
  });

  const removeProduct = getElement('.remove');
  removeProduct.addEventListener('click', async () => {
    let checks = false;
    const products = document.querySelectorAll('.product-checkbox');
    for (let i = 0; i < products.length; i++) {
      if (products[i].checked) {
        checks = true;

        let removeItem = await fetch('http://backend.has-precast.com/remove-to-cart', {
          credentials: 'include',
          method: 'POST',
          body: createFormData({ cart_id: products[i].dataset.cartId })
        });
      }
    }
    if (checks) createCartItems();
    else location = location + `?message=${encodeURI('Select an item first')}&top=10&right=5&type=error`;
  });

  const addProduct = getElement('.add');
  addProduct.addEventListener('click', async () => {

    let response = await fetch('http://backend.has-precast.com/get-products', { credentials: 'include', });

    data = await response.json();
    if (data) {
      cartActions.style.display = 'none';
      cartContents.style.display = 'none';

      const selectContainer = insertSelectProduct();
      const selectProduct = getElement('.select-product');

      let options = '';
      for (const product of data) options += `<option value="${product.design_name}">${product.design_name}</option>`
      selectProduct.innerHTML = options;

      selectProduct.addEventListener('change', (e) => {
        product = data.find((product) => product.design_name === e.target.value);
        getElement('.selected-image').innerHTML = `<img src="/website/assets/images/products/${product.cart_image}">`;
      });
      selectProduct.dispatchEvent(new Event('change'));

      getElement('.close-select').addEventListener('click', () => {
        getElement('.select-product-container').remove();
        cartActions.style.display = 'block';
        cartContents.style.display = 'block';
      });

      getElement('.add-select').addEventListener('click', async () => {
        let quantity = getElement('.selected-data .quantity').value;
        if (quantity == 0) {
          location = location + `?message=${encodeURI('Invalid input. Please try again.')}&top=10&right=5&type=error`;
          return;
        } else if (quantity < 100) {
          location = location + `?message=${encodeURI('The minimum quantity is 100. Please try again.')}&top=10&right=5&type=error`;
          return;
        } else if (quantity > 1000000) {
          location = location + `?message=${encodeURI('The maximum quantity is 1,000,000. Please try again.')}&top=10&right=5&type=error`;
          return;
        }

        let cartItemResponse = await fetch('http://backend.has-precast.com/add-to-cart', {
          credentials: 'include',
          method: 'POST',
          body: createFormData({
            account_id: user.id,
            wall_form_block_id: product.id,
            size: getElement('.selected-data .size').value,
            quantity: quantity,
          })
        });

        cartItem = await cartItemResponse.json();
        createCartItems();

        selectContainer.remove();
        cartActions.style.display = 'block';
        cartContents.style.display = 'block';
      });
    }
  });
}

async function createOrders() {
  let ordersResponse = await fetch('http://backend.has-precast.com/get-orders', {
    credentials: 'include',
    method: 'POST',
    body: createFormData({ account_id: user.id })
  });

  const orders = await ordersResponse.json();
  return (Array.isArray(orders)) ? {} : orders;
}

async function createCartItems() {
  let cartResponse = await fetch('http://backend.has-precast.com/get-cart', {
    credentials: 'include',
    method: 'POST',
    body: createFormData({ account_id: user.id })
  });

  const cart = await cartResponse.json();
  if (cart) {
    const cartContents = getElement('.cart-contents');
    cartContents.innerHTML = '';

    for (const product of cart) {
      cartContents.innerHTML = `
        <label for="select-product-${product.cart_id}">
          <div class="product">
            <input class="product-checkbox" type="checkbox" id="select-product-${product.cart_id}"
             data-cart-id="${product.cart_id}" data-wfb-id="${product.wfb_id}"
             data-wfb-size='${product.size}' data-wfb-quantity="${product.quantity}"">
            <div class="product-data">
              <h3 class="design">${product.design_name}</h3>
              <div class="product-details">
                <h3 class="quantity">qty: ${product.quantity}</h3>
                <h3 class="size">size: ${product.size}</h3>
              </div>
            </div>
          </div>
          <div class="overlay">
            <h3>${product.design_name}</h3>
            <div><img src="/website/assets/images/products/${product.cart_image}" alt="product-image"></div>
            <h3>Description: </h3>
            <p>${product.description}</p>
          </div>
        </label>` + cartContents.innerHTML;
    }
  }
}

function insertSelectProduct() {
  const cart = getElement('.cart');
  const selectContainer = document.createElement('div');
  selectContainer.classList.add('select-product-container');
  selectContainer.innerHTML = `
      <h2>Select a Design: </h2>
      <select class="select-product">
      </select>
      <div class="selected-product">
        <div class="selected-image"></div>
      </div>
      <div class="selected-data">
        <label>Size: </label>
        <select class="size">
          <option value='4"'>4"</option>
          <option value='5"'>5"</option>
          <option value='6"'>6"</option>
          <option value='8"'>8"</option>
        </select>
        <label>Quantity: </label>
        <input required type="number" class="quantity">
      </div>
      <div class="select-buttons">
        <button class="add-select">Add</button>
        <button class="close-select">Close</button>
      </div>`;

  cart.appendChild(selectContainer);
  return selectContainer;
}

function toggleCartAndOrders(toggleOrder = false) {
  const toggleCart = getElement('.toggle-cart');
  const toggleOrders = getElement('.toggle-orders');

  toggleCart.addEventListener('click', () => {
    const cart = document.querySelector('.cart');
    cart.style.display = 'block';

    const orders = document.querySelector('.orders');
    orders.style.display = 'none';

    toggleCart.classList.add('active-tab');
    toggleOrders.classList.remove('active-tab');
  });

  toggleOrders.addEventListener('click', () => {
    getElement('.cart').style.display = 'none';
    getElement('.orders').style.display = 'block';

    toggleCart.classList.remove('active-tab');
    toggleOrders.classList.add('active-tab');
  });

  if (toggleOrder) toggleOrders.click();
  else toggleCart.click();
}

function enableSidebarState() {
  const toggleSidebar = document.querySelector('#toggle-sidebar');

  if (localStorage.getItem('toggle-sidebar') === 'true') toggleSidebar.click();

  toggleSidebar.addEventListener('click', () =>
    localStorage.setItem('toggle-sidebar', (toggleSidebar.checked) ? 'true' : 'false')
  );
}