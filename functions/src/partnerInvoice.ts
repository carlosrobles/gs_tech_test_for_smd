import AWS from 'aws-sdk';

export const partnerInvoice = (event: any = {}) => {
    console.log('partner...............');
    const sqs = new AWS.SQS({apiVersion: '2012-11-05'});
    const params = {
        MessageBody: JSON.stringify({
            order_id: 1234,
            date: (new Date()).toISOString()
        }),
        QueueUrl: "https://sqs.ap-south-1.amazonaws.com/521151258604/item-bundle-standard"
    };
    sqs.sendMessage(params, (err, data) => {
        if (err) {
            console.log("Error", err);
        } else {
            console.log("Successfully added message", data.MessageId);
        }
    });
}