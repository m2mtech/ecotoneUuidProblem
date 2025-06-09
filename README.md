# Ecotone Symfony Bundle Reproduction

This repository demonstrates an error when upgrading `ecotone/symfony-bundle` from `v1.255` to `v1.256`.

## Setup

1. Install PHP dependencies:
   ```bash
   docker compose run php83 composer update
   ```

2. Run tests:

   ```bash
   docker compose run php83 bin/phpunit
   ```

## Error

Running the test produces:

<details>
  <summary>
    1) tests\ProblemTest::testWithEcotoneHelper
    
       Error: Typed static property Symfony\Component\Uid\UuidV7::$seedParts must not be accessed before initialization
  </summary>

/app/vendor/jms/serializer/src/Accessor/DefaultAccessorStrategy.php:84   
/app/vendor/jms/serializer/src/GraphNavigator/SerializationGraphNavigator.php:277   
/app/vendor/jms/serializer/src/JsonSerializationVisitor.php:139   
/app/vendor/jms/serializer/src/GraphNavigator/SerializationGraphNavigator.php:287   
/app/vendor/jms/serializer/src/JsonSerializationVisitor.php:139   
/app/vendor/jms/serializer/src/GraphNavigator/SerializationGraphNavigator.php:287   
/app/vendor/jms/serializer/src/Serializer.php:256   
/app/vendor/jms/serializer/src/Serializer.php:202   
/app/vendor/ecotone/jms-converter/src/JMSConverter.php:45   
/app/vendor/ecotone/ecotone/src/Messaging/Conversion/AutoCollectionConversionService.php:65   
/app/vendor/ecotone/ecotone/src/Modelling/AggregateIdentifierRetrevingService.php:67   
/app/vendor/ecotone/ecotone/src/Messaging/Handler/RequestReplyProducer.php:28   
/app/vendor/ecotone/ecotone/src/Messaging/Channel/DirectChannel.php:39   
/app/vendor/ecotone/ecotone/src/Messaging/Handler/Processor/SendToChannelProcessor.php:21   
/app/vendor/ecotone/ecotone/src/Messaging/Handler/Router/RouterProcessor.php:32   
/app/vendor/ecotone/ecotone/src/Messaging/Handler/RequestReplyProducer.php:28   
/app/vendor/ecotone/ecotone/src/Messaging/Channel/DirectChannel.php:39   
/app/vendor/ecotone/ecotone/src/Messaging/Handler/Gateway/GatewayInternalProcessor.php:70   
/app/vendor/ecotone/ecotone/src/Messaging/Handler/Processor/MethodInvoker/AroundMethodInvocation.php:57   
/app/vendor/ecotone/ecotone/src/Modelling/MessageHandling/MetadataPropagator/MessageHeadersPropagatorInterceptor.php:42   
/app/vendor/ecotone/ecotone/src/Messaging/Handler/Processor/MethodInvoker/AroundMethodInvocation.php:67   
/app/vendor/ecotone/ecotone/src/Messaging/Handler/Processor/MethodInvoker/AroundMessageProcessor.php:33   
/app/vendor/ecotone/ecotone/src/Messaging/Handler/Processor/ChainedMessageProcessor.php:24   
/app/vendor/ecotone/ecotone/src/Messaging/Handler/Gateway/Gateway.php:78   
/tmp/ecotone/e73360218d503629fa3a6cfb15f4d88fef65eac0/Ecotone_Modelling_CommandBus.php:18   
/app/vendor/ecotone/ecotone/src/Lite/Test/FlowTestSupport.php:54   
/app/tests/ProblemTest.php:26   

</details>

## Context

* PHP: 8.3 (also tested with 8.4)
* Symfony: 6.4 (also tested with 7.3)
* Ecotone: v1.256 (no issue in v1.255)

The error occurs when event sourcing is used and the change command contains an entity with a `Uuid`.

## Reproduction

See [tests/ProblemTest.php](tests/ProblemTest.php).
