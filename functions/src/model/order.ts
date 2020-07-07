export interface Order {
    orderId : number,
    partner: string | boolean,
    items: Array<Item>
}

export interface Item {
    orderId: number,
    itemId: number,
    partner: string,
}