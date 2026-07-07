const EXCHANGE_RATES = { USD: 1, EUR: 0.92, BDT: 110, GBP: 0.79 };
let currentCurrency = localStorage.getItem('gc_currency') || 'USD';

export const formatPrice = (amount) => {
    const converted = amount * EXCHANGE_RATES[currentCurrency];
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: currentCurrency
    }).format(converted);
};

export const switchCurrency = (ccy) => {
    localStorage.setItem('gc_currency', ccy);
    location.reload();
};