# วิธีการติดตั้ง
#### 1. สร้างฐานข้อมูลชื่อ fooddelivery
#### 2. สร้างตารางลูกค้าชื่อ customer
ข้อมูลในตาราง customer ประกอบด้วย

| Name | Type | Length | Primary Key | Auto Increment |
| --- | --- | --- | --- | --- |
| id | int | - | Yes | Yes |
| email | varchar | 255 | No | No |
| username | varchar | 255 | No | No |
| password | varchar | 255 | No | No |
| firstname | varchar | 255 | No | No |
| lastname | varchar | 255 | No | No |
| phone | varchar | 10 | No | No |
| address | varchar | 255 | No | No |
| image | varchar | 255 | No | No |
| status | varchar | 255 | No | No |

#### 3. สร้างตารางร้านอาหารชื่อ restaurant
ข้อมูลในตาราง restaurant ประกอบด้วย

| Name | Type | Length | Primary Key | Auto Increment |
| --- | --- | --- | --- | --- |
| id | int | - | Yes | Yes |
| email | varchar | 255 | No | No |
| username | varchar | 255 | No | No |
| password | varchar | 255 | No | No |
| firstname | varchar | 255 | No | No |
| lastname | varchar | 255 | No | No |
| phone | varchar | 10 | No | No |
| address | varchar | 255 | No | No |
| image | varchar | 255 | No | No |
| restaurant_name | varchar | 255 | No | No |
| restaurant_type | varchar | 255 | No | No |
| status | varchar | 255 | No | No |