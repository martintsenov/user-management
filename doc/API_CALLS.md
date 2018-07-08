API calls
---------
* POST <host_url>/user/add
  request post
  [
    'name' => name,
    'email' => email
  ]

* GET <host_url>/user/details/<user_id>
  response
  [
    'name' => name,
    'email' => email
    'groups' => [
      [
        'íd' => id,
        'name' => name,
        'description' => id,
      ]
    ]
  ]

* POST <host_url>/user/delete/<user_id>

* POST <host_url>/user/add-to-group
  request post
  [
    'user_id' => id,
    'group_id' => id
  ]  

* POST <host_url>/user/remove-from-group/<user_id>/<group_id>

* GET <host_url>/user/list
  response
  [
    'users' => [
      [
        'íd' => id,
        'name' => name,
      ]
    ]
  ]

* GET <host_url>/group/list
  response
  [
    'groups' => [
      [
        'íd' => id,
        'name' => name,
        'description' => description
      ]
    ]
  ]

* POST <host_url>/group/create
  request post
  [
    'name' => name,
    'description' => description
  ]

* POST <host_url>/group/delete/<group_id>
