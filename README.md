The project is focused on providing an online service for hashing strings while maintaining the secrecy of the salt used in the process.
This project aims to offer a secure and efficient way to hash strings by keeping the salt confidential.
By hashing strings as a service, users can benefit from the security and reliability of the hashing process without having to manage the salt themselves.
In fact there is no way for them to access to the salt used, unless they have access to the hosted service.

![RESTer_example](https://github.com/aleppax/HashaaS/assets/6873524/19ad9e11-8830-4ab8-b04e-b606a9f55bd7)


Plain or hashed strings are not stored in the server, but returned upon each request. The server encrypts the salt associated to an API key using an Initialization Vector stored in an environment variable.

Hashing strings can be a technique to offer pseudonymity by transforming data into a fixed-length character series, known as a hash value. 
This process ensures that the same input always yields the same output, making it deterministic and irreversible. 
However, it's crucial to consider the risks of re-identification when using hash functions for pseudonymisation or anonymisation.

The GDPR has a fairly broad concept of what it means for a data subject to be identifiable. The details are given in Recital 26:

>  To determine whether a natural person is identifiable, account should be taken of all the means reasonably likely to be used, such as singling out, either by the controller or by another person to identify the natural person directly or indirectly. To ascertain whether means are reasonably likely to be used to identify the natural person, account should be taken of all objective factors, such as the costs of and the amount of time required for identification, taking into consideration the available technology at the time of the processing and technological developments.

The General Data Protection Regulation (GDPR) interprets "identify" to mean not only the ability to determine the actual identity of an individual but also the capacity to distinguish or isolate that person's data from others. 
This implies that even if the data subject's real-world identity is not known, being able to separate their data from that of others is still considered identifying them under GDPR.

In other words: contextual information varies case by case and relies on how hashed data maintains connections to other data, enabling indirect identification.

Finally, this service offers a method that we believe is safe to pseudonymize data without storing it, so whoever handles the data needs to know that they are still processing personal data.

In rare cases, i.e. when it is demonstrable that no other personal data is collected and no relationship can be reconstructed between the hashed data and identifying information, it is possible to speak of anonymisation instead of pseudonymisation, thus falling outside the GDPR.

> [!TIP]
> For example: a system collects data on vehicular traffic, recording passages through a series of gates at fixed points in the city.
> The purpose of the system is to generate aggregate data on flow directions and has no interest in tracking the individual vehicle.
> The license plate is hashed via an online service with an unknown salt and forgotten.
> The hash of the license plate is saved by the system together with the time and place of the passage.
> It is still possible to use the information to generate an aggregate analysis on flows without having a way to associate the license plate or its hashed version with other data that could identify an individual.

> [!CAUTION]
> But if the system in the example above had such a spatial and temporal capillarity of data collection that it could allow with reasonable certainty to understand the habits of a certain individual, despite not knowing his identity, it would fall within the scope of the GDPR.

There are already many similar projects on Github, such as by:

[adilakhter - hashing-as-a-service](https://github.com/adilakhter/hashing-as-a-service)

[EtaCassiopeia - hashing-as-a-service-cli](https://github.com/EtaCassiopeia/hashing-as-a-service-cli)

and so on.

## Usage

> GET /hashaas.php

with headers:

> api-key: 1234567890123456

> payload: OnceUponATime

the response will be the hashed payload.
