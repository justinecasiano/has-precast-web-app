const params = new URL(location).searchParams;
showNotification();

function showNotification() {
  window.history.pushState(null, "", location.pathname);
  if (!params.get('message')) return;

  const notif = document.createElement('div');
  notif.classList.add('notification');

  const types = {
    success: {
      text: '#6bc99d',
      background: '#f0fcf6'
    },
    error: {
      text: '#fa3434',
      background: '#ffeced'
    }
  }

  notif.innerHTML = params.get('message');
  notif.style.backgroundColor = types[params.get('type')].background || '#fcdbdf';
  notif.style.top = `${params.get('top')}%`;
  notif.style.right = `${(params.get('right') || 0)}%`;
  notif.style.borderColor = types[params.get('type')].text || '#EF4D62';
  notif.style.color = types[params.get('type')].text || '#EF4D62';
  if (!params.get('right')) notif.style.left = 0;

  setTimeout(() => document.querySelector('body').appendChild(notif), 400);
  setTimeout(() => notif.remove(), 10000);
}

function getElement(element) {
  return document.querySelector(element);
}

function createFormData(object) {
  const formData = new FormData();
  for (const [key, value] of Object.entries(object)) formData.append(key, value);
  return formData;
}

function numFormat(number) {
  return new Intl.NumberFormat('fil-PH', { style: 'currency', currency: 'PHP' }).format(number);
}