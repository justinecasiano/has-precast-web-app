setInterval(() => getUser(), 1000);

let user = {};
let lastSender = '';
let lastBillingID = 1001;
let lastOpenedChat;
let chatToggled = false;
let currentChatTab = null;
let clientLastMessageID = 1001;
let hasInsertedMessage = true;
let hasInsertedBillings = false;
let cartVisible = false;
let loginVisible = false;

async function getUser() {
  let response = await fetch('http://backend.has-precast.com', { credentials: 'include' });
  let data = await response.json();

  if (data.email !== 'none' && !hasInsertedBillings) {
    user = data;
    await setupBillings();

    const heading = getElement('.order-heading');
    heading.innerText = 'Billings';
  } else {
    await getNewBillings();
  }

  if (params.get('toggleChat') && !chatToggled) {
    document.querySelectorAll(`.message-button`)[params.get('toggleChat')].click();
    chatToggled = true;
  }
}

async function setupBillings() {
  const orders = await createOrders();
  const orderContents = getElement('.order-contents');
  const chatContents = getElement('.chat-contents');

  orderContents.innerHTML = '';
  chatContents.innerHTML = '';

  console.log(orders);
  if (Object.keys(orders).length) {
    for (const [key, values] of Object.entries(orders)) {
      let orderList = '';

      for (const order of values.orders) {
        orderList = `
          <details class="order-item" data-order-id=${order.order_id} open>
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
          <div data-id="${key}" class="contract-form" id="contract-form-${key}">
            <h1>Contract</h1>
            <form action="http://backend.has-precast.com/set-payment-status" method="post">
              <h4>Payment Method:</h4>
              <h4 class="payment-method"></h4>
              <h4>Payment Reference Number:</h4>
              <h4 class="payment-reference"></h4>
              <div>
                <h4>Preferred Delivery Date:</h4>
                <h4 class="delivery-date"></h4>
              </div>
              <label>Payment Status:</label>
              <select name="payment_status" class="payment-status">
                <option value="UNPAID">UNPAID</option> 
                <option value="VERIFYING">VERIFYING</option> 
                <option value="PAID">PAID</option> 
              </select>
              <input type="hidden" name="billing_id" value=${key}>
              <div>
                <button class="submit-status">Submit Status</button>
                <button type="button" class="close-payment">Close</button>
              </div>
            </form>
          </div>` + orderContents.innerHTML;

      chatContents.innerHTML =
        `<div class="chat toggle-chat" id="chat-${key}">
          <div class="chat-actions">
            <button id="close-chat-${key}" class="button close-chat"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z"/></svg></button>
            <div class="chat-info">
              <div>
                <h2>Billing ${key}</h2>
                <h2>Type: ${values.type}</h2>
              </div>
              <h2>Client: ${values.name}</h2>
            </div>
          </div>
          <div class="chat-container">
            <div class="chat-box" id="chat-box-${key}"></div>
            <form data-id="${key}" class="chat-form" id="chat-form-${key}">
              <button type="button" id="quotation-button-${key}" class="button quotation-button"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 20 20"><g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"><path d="M11 3.5H6v-2h5a5 5 0 0 1 5 5v1a5 5 0 0 1-5 5H6v-2h5a3 3 0 0 0 3-3v-1a3 3 0 0 0-3-3"/><path d="M6 1.5a1 1 0 0 1 1 1V18a1 1 0 1 1-2 0V2.5a1 1 0 0 1 1-1"/><path d="M2 5.436a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1m0 3a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1"/></g></svg></button>
              <input id="message-${key}" class="message" type="text" name="message">
              <button id="send-button-${key}" class="button send-button"><svg xmlns="http://www.w3.org/2000/svg" width="0.94em" height="1em" viewBox="0 0 15 16"><path fill="currentColor" d="M12.49 7.14L3.44 2.27c-.76-.41-1.64.3-1.4 1.13l1.24 4.34q.075.27 0 .54l-1.24 4.34c-.24.83.64 1.54 1.4 1.13l9.05-4.87a.98.98 0 0 0 0-1.72Z"/></svg></button>
            </form>
            <div class="add-quote toggle-quote">
              <div>
                <h3>Set a quotation: </h3>
                <button type="button" class="close-quote">Close</button>
              </div>
              <h4>How much is the total amount:</h4>
              <input type="number" name="quote-amount" class="quote-input">
              <h4>Confirm total amount:</h4>
              <input type="number" name="confirm-quote-amount" class="confirm-quote-input">
              <details class="orders" open>
                <summary class="orders-heading">
                <h3>Orders</h3>
                </summary>
                ${orderList}
              </details>
              <button type="button" class="confirm-quote">Confirm</button>
            </div>
          </div>
        </div>`
        + chatContents.innerHTML;

      lastBillingID = key;
    }
    addOrderEventListeners();
    orderContents.scrollTop = 0;
    hasInsertedBillings = true;
    addContractEventListeners();
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

async function getNewBillings() {
  let getBillings = await fetch('http://backend.has-precast.com/get-new-billing', {
    credentials: 'include',
    method: 'POST',
    body: createFormData({ billing_id: lastBillingID })
  });

  const billings = await getBillings.json();

  if (billings && !Array.isArray(billings)) {
    hasInsertedBillings = false;
  }
}

async function getNewMessages(id, chatBox) {
  let getMessages = await fetch('http://backend.has-precast.com/get-new-message', {
    credentials: 'include',
    method: 'POST',
    body: createFormData({ billing_id: id, id: clientLastMessageID })
  });

  const messages = await getMessages.json();

  if (messages.length > 0) {
    for (const message of messages) {
      if (message.message.includes('Client has accepted the quotation price of:') ||
        message.message.includes('Client has rejected the quotation price of:')) {
        location = location + `?toggleChat=${lastOpenedChat}`;
      }
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

function createMessage(key, message, type = 'TEXT') {
  const chatBox = getElement(`#chat-box-${key}`);

  const chatMessage = document.createElement('div');
  const status = document.createElement('div');

  if (lastSender !== 'ADMIN') {
    const name = document.createElement('div');
    name.innerText = 'ADMIN';
    name.style.fontWeight = 'bold';
    name.style.paddingRight = '5px';
    name.classList.add('name', 'anchor-right');

    chatBox.appendChild(name);
    lastSender = 'ADMIN';
  }

  chatMessage.classList.add('chat-message', 'anchor-right');
  (message.includes('"type":"QUOTE"')) ?
    chatMessage.innerHTML = JSON.parse(message).message :
    chatMessage.innerText = message;
  chatBox.appendChild(chatMessage);

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
    name.innerText = (message.sender !== 'ADMIN') ? message.name.toUpperCase() : 'ADMIN';
    name.style.fontWeight = 'bold';
    name.classList.add('name', (message.sender !== 'ADMIN') ? 'anchor-left' : 'anchor-right');

    if (message.sender !== 'ADMIN') name.style.paddingRight = '5px';
    else name.style.paddingLeft = '5px';

    chatBox.appendChild(name);
    lastSender = message.sender;
  }

  if (message.sender === 'CLIENT') clientLastMessageID = message.id;

  let anchor = (message.sender === 'CLIENT') ? 'anchor-left' : 'anchor-right';
  chatMessage.style.backgroundColor = (message.sender === 'CLIENT') ? 'var(--clr-primary-shade)' : 'var(--clr-accent)';
  chatMessage.style.color = (message.sender === 'CLIENT') ? 'var(--clr-secondary)' : 'var(--clr-primary)';
  chatMessage.classList.add('chat-message', anchor);

  (message.message.includes('"type":"QUOTE"')) ?
    chatMessage.innerHTML = JSON.parse(message.message).message :
    chatMessage.innerText = message.message;

  chatBox.appendChild(chatMessage);

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
      let paymentStatus = contractForm.querySelector('.payment-status');
      let payment = await getPayment(contractButtons[i].dataset.id);

      console.log(payment);
      if (payment && payment['payment_method'] !== null) {
        paymentMethod.innerText = payment['payment_method'];
        deliveryDate.innerText = payment['delivery_date'];
        paymentReference.innerText = payment['payment_reference'];
        paymentStatus.value = payment['payment_status'];

        contractForm.querySelector('.submit-status').disabled = false;
      } else {
        contractForm.querySelector('.submit-status').disabled = true;
      }

      let closeButton = contractForm.querySelector('.close-payment');
      closeButton.addEventListener('click', () => {
        contractForm.style.display = 'none';
      });
    });
  }
}

function addOrderEventListeners() {
  const messageButtons = document.querySelectorAll('.message-button');
  const chats = document.querySelectorAll('.chat');

  for (let i = 0; i < chats.length; i++) {
    const closeButton = chats[i].querySelector('.close-chat');
    const quotationButton = chats[i].querySelector('.quotation-button');
    const sendButton = chats[i].querySelector('.send-button');
    const closeQuoteButton = chats[i].querySelector('.close-quote');
    const confirmQuoteButton = chats[i].querySelector('.confirm-quote');
    const messageBox = chats[i].querySelector('.message');
    const addQuote = chats[i].querySelector('.add-quote');
    const chatForm = chats[i].querySelector('.chat-form');
    const chatBox = chats[i].querySelector('.chat-box');

    messageButtons[i].addEventListener('click', async () => {
      lastOpenedChat = i;

      if (!addQuote.style.display !== 'none') closeQuoteButton.click();

      if (currentChatTab !== closeButton) {
        if (currentChatTab) currentChatTab.click();
        currentChatTab = closeButton;
      } else return;

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
      currentChatTab = '';
      chatBox.innerHTML = '';
      chats[i].classList.toggle('toggle-chat');
      lastSender = '';

      if (!addQuote.style.display !== 'none') closeQuoteButton.click();
    });

    quotationButton.addEventListener('click', async (e) => {
      let quotation = await getQuotation(chatForm.dataset.id);
      console.log(quotation);
      if (quotation) {
        location = location + `?message=${encodeURI('Quotation has already been set')}&top=10&toggleChat=${lastOpenedChat}&right=10&type=error`;
        return;
      }
      sendButton.disabled = true;
      addQuote.style.display = 'flex';

      closeQuoteButton.addEventListener('click', () => {
        sendButton.disabled = false;
        addQuote.style.display = 'none';
      });

      confirmQuoteButton.addEventListener('click', () => {
        const quoteInput = document.querySelectorAll('.quote-input')[i].value;
        const confirmQuoteInput = document.querySelectorAll('.confirm-quote-input')[i].value;

        if (!(quoteInput && confirmQuoteInput)) {
          location = location + `?message=${encodeURI('No empty inputs. Please try again.')}&top=10&toggleChat=${lastOpenedChat}&right=10&type=error`;
          return;
        } else if ((quoteInput < 5000)) {
          location = location + `?message=${encodeURI('The minimum total amount is ₱5,000.<br> Please try again.')}&top=10&toggleChat=${lastOpenedChat}&right=10&type=error`;
          return;
        } else if ((quoteInput !== confirmQuoteInput)) {
          location = location + `?message=${encodeURI('Total amount does not match confirm total amount. Please try again.')}&top=10&toggleChat=${lastOpenedChat}&right=10&type=error`;
          return;
        }

        let quote = `
          <div data-quote=${quoteInput} class="quote-offer">
            <div>An offer has been set for Billing ${chatForm.dataset.id}</div>
            <div><b>The Total Amount is: ${numFormat(quoteInput)}</b></div>
            <button class="accept-quote">Accept</button>
            <button class="reject-quote">Reject</button>
          </div>`;

        location = location + `?message=${encodeURI('Quotation is successfully set.')}&top=10&toggleChat=${lastOpenedChat}&right=10&type=success`;

        messageBox.value = JSON.stringify({ type: 'QUOTE', message: quote });
        sendButton.disabled = false;
        sendButton.click();
      });
    });

    chatForm.addEventListener('submit', async (e) => {
      e.preventDefault();

      let key = chatForm.dataset.id;
      let message = getElement(`#message-${key}`);
      let isCooldown = false;

      if (!isCooldown && message.value) {
        const chatBox = getElement(`#chat-box-${key}`);

        const text = message.value;
        const status = createMessage(key, message.value);

        chatBox.scrollTop = chatBox.scrollHeight;
        chatForm.reset();
        const response = await sendMessage(text, key, 'ADMIN');
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

async function getQuotation(id) {
  let getQuotation = await fetch('http://backend.has-precast.com/get-quotation', {
    credentials: 'include',
    method: 'POST',
    body: createFormData({ billing_id: id })
  });

  return getQuotation.json();
}

async function sendMessage(message, id, sender = 'CLIENT') {
  let sendMessage = await fetch('http://backend.has-precast.com/send-message', {
    credentials: 'include',
    method: 'POST',
    body: createFormData({ billing_id: id, message: message, sender: sender })
  });

  return sendMessage.json();
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