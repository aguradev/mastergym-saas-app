export default function FormatCurrency(price) {
    return new Intl.NumberFormat("ID", {
        style: "currency",
        currency: "IDR",
    }).format(price);
}
