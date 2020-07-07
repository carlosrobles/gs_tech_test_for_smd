import AWS from 'aws-sdk';
import {Order, Item} from './model/order';

let order: Order;
let partnerItemsBundle: Array<Item> = [];
let mvhItemsBundle: Array<Item> = [];
const itemBundleStandard = "https://sqs.ap-south-1.amazonaws.com/521151258604/item-bundle-standard";

export const partnerInvoice = (event: any, context: any) => {
    event.Records.forEach(record => {
            const body = JSON.parse(record.body);
            order = {
                orderId: body.order_id,
                partner: body.partner,
                items: Object.entries(body.items).map((item: any) => {
                        return {
                            orderId: body.order_id,
                            itemId: item[1].item_id,
                            partner: body.partner,
                        }
                    }
                )
            }
        }
    );
    console.log(order);
    if (!order.partner) {
        mvhItemsBundle = order.items;
    } else {
        for (const [key, item] of order.items.entries()) {
            if (key % 2) {
                mvhItemsBundle.push(item)
            } else {
                partnerItemsBundle.push(item)
            }
        }
    }

    if (partnerItemsBundle.length > 0) {
        publish(
            partnerItemsBundle,
            itemBundleStandard
        )
        console.log('published partner')
    }
    if (mvhItemsBundle.length > 0) {
        publish(
            mvhItemsBundle,
            itemBundleStandard
        )
        console.log('published mvh')
    }
}

const publish = ($message, $queueUrl) => {
    const sqs = new AWS.SQS({apiVersion: '2012-11-05'});
    const params = {
        MessageBody: JSON.stringify($message),
        QueueUrl: $queueUrl
    };
    sqs.sendMessage(params, (err, data) => {
        if (err) {
            console.log("Error", err);
        } else {
            console.log("Successfully added message", data.MessageId);
        }
    });
}