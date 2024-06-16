export default function FormatCurrency(price) {
    return new Intl.NumberFormat("ID", {
        style: "currency",
        currency: "IDR",
        maximumFractionDigits: 0,
    }).format(price);
}
