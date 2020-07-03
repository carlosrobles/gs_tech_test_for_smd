## Project description

## List of tasks before start the project
* Setup magento 1.9 with mysql
    * estimation - 3 hrs
    * actual - 4 hrs
* Refresh 4 years old magento 1.9 memories.
    * estimation - 4 hrs
* Understand the project requirements.
    * estimation - 1 hrs
    * actual - 1 hrs
* Design the project and picture it
    * estimation - 3 hrs
    * actual - 2 hrs
* Spike on AWS SQS
    * estimation - 2 hrs
* Spike on AWS lambda function
    * estimation - 3 hrs
* Spike on AWS VM
    * estimation - 2 hrs
* Spike on AWS PHP SDK
    * estimation - 1 hrs
* List all the task and estimate time with considering estimations can go wrong.
    * estimation - 1hrs

## System diagram
![GitHub Logo](/doc/Partner%20Invoice-Page-1.png)
#### Why a queue system?
* In future there is high possibility that we need to check available to promise items (ATP) with store's inventory. so with this architecture we can communicate with 3rd party system requests without delaying the ordering process.

## Pseudo code
#### Register partner in magento
```
if(cookie.partner != null && cookie.partner.isValid) {
    order.partner = cookie.partner
} else {
    order.partner = null;
}
```

#### Identify partner invoice item function
```
if(order.partner != null) {
    foreach(order.items as i => item) {
        if(i%2) {
            mark the item for main warehouse
        } else {
            mark the item for partner
        }
    }
} else {
    // cookie is invalid or not set
    mark all items for main warehouse
}
```

#### POST endpoint
```
generateInvoice(items);
generateShipment(items);
ack();
```

## Decisions/Assumptions
* if the item index is odd, it goes to partner
* Main warehouse(MWH) and partner have access to orders.
* If partner cookie is invalid or not set, then all items goes to MWH

## List of tasks
1. Capture partner in magento
    * create a partner module
    * create partner schema
    * feed some partner data
    * create partner cookie
    * register partner cookie value with order
2. Publish new order event to AWS SQS
    * install AWS PHP SDK
    * create new order event observer
    * publish new order event to new-order-queue
3. Invoice partner
    * create a function to do invoice partner
    * bundle the items based the pseudo code given above
    * publish the message to item-bundle queue
4. Push item bundle to magento endpoint
5. Create invoice in magento based on item bundle message
6. Create shipment in magento based on item bundle message
7. Host magento on AWS VM
8. Import sample products
9. View the products in home page

## TODO
* write what can be done more to improve.