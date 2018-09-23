#include <eosiolib/eosio.hpp>

using namespace eosio;

class perseos : public eosio::contract
{
public:
  using contract::contract;

  /// @abi action
  void createuser(account_name user,
                  std::string firstname,
                  std::string lastname,
                  std::string email,
                  std::string phoneNumber,
                  std::string liveIdPhoto,
                  std::string govIdNumber,
                  std::string govIdPhoto,
                  std::string passportIdNumber,
                  std::string passportIdPhoto,
                  std::string drivingLincenceIdNumber,
                  std::string drivingLincenceIdPhoto,
                  std::string street,
                  std::string city,
                  std::string proofOfAddress,
                  std::string certifiedIncome,
                  std::string country)
  {
    require_auth(user);

    user_index users(_self, _self);

    auto userDb = users.find(user);
    if (userDb != users.end())
    {
      print("Users already exists");
    }
    else
    {
      users.emplace(_self, [&](auto &newUser) {
        newUser.id = user;
        newUser.firstname = firstname;
        newUser.lastname = lastname;
        newUser.email = email;
        newUser.phoneNumber = phoneNumber;
        newUser.liveIdPhoto = liveIdPhoto;
        newUser.govIdNumber = govIdNumber;
        newUser.govIdPhoto = govIdPhoto;
        newUser.passportIdNumber = passportIdNumber;
        newUser.passportIdPhoto = passportIdPhoto;
        newUser.drivingLincenceIdNumber = drivingLincenceIdNumber;
        newUser.drivingLincenceIdPhoto = drivingLincenceIdPhoto;
        newUser.street = street;
        newUser.city = city;
        newUser.proofOfAddress = proofOfAddress;
        newUser.certifiedIncome = certifiedIncome;
        newUser.country = country;
      });
      print("User successfuly created");
    }
  }

  void createaccess(account_name user,
               uint64_t applicationId,
               std::string firstname,
               std::string lastname,
               std::string email,
               std::string phoneNumber,
               std::string liveIdPhoto,
               std::string govIdNumber,
               std::string govIdPhoto,
               std::string passportIdNumber,
               std::string passportIdPhoto,
               std::string drivingLincenceIdNumber,
               std::string drivingLincenceIdPhoto,
               std::string street,
               std::string city,
               std::string proofOfAddress,
               std::string certifiedIncome,
               std::string country)
  {
    require_auth(user);

    access_index accesses(_self, _self);

    auto accessDb = accesses.find(applicationId * 1000000 + user);
    if (accessDb != accesses.end())
    {
      print("Users is already registered in this service");
    }
    else
    {
      accesses.emplace(_self, [&](auto &newAccess) {
        newAccess.userId = user;
        newAccess.applicationId = applicationId;
        newAccess.firstname = firstname;
        newAccess.lastname = lastname;
        newAccess.email = email;
        newAccess.phoneNumber = phoneNumber;
        newAccess.liveIdPhoto = liveIdPhoto;
        newAccess.govIdNumber = govIdNumber;
        newAccess.govIdPhoto = govIdPhoto;
        newAccess.passportIdNumber = passportIdNumber;
        newAccess.passportIdPhoto = passportIdPhoto;
        newAccess.drivingLincenceIdNumber = drivingLincenceIdNumber;
        newAccess.drivingLincenceIdPhoto = drivingLincenceIdPhoto;
        newAccess.street = street;
        newAccess.city = city;
        newAccess.proofOfAddress = proofOfAddress;
        newAccess.certifiedIncome = certifiedIncome;
        newAccess.country = country;
      });
      print("User successfuly registered");
    }
  }

  void getuserdata(account_name user, uint64_t applicationId, std::string property)
  {
    require_auth(user);

    access_index accesses(_self, _self);

    auto accessDb = accesses.find(applicationId * 1000000 + user);
    if (accessDb == accesses.end())
    {
      print("Users is not registered in this service");
    }
    else
    {
      if (property == "firstname")
        print(accessDb->firstname);
      if (property == "lastname")
        print(accessDb->lastname);
      if (property == "email")
        print(accessDb->email);
      if (property == "phoneNumber")
        print(accessDb->phoneNumber);
      if (property == "liveIdPhoto")
        print(accessDb->liveIdPhoto);
      if (property == "govIdNumber")
        print(accessDb->govIdNumber);
      if (property == "govIdPhoto")
        print(accessDb->govIdPhoto);
      if (property == "passportIdNumber")
        print(accessDb->passportIdNumber);
      if (property == "passportIdPhoto")
        print(accessDb->passportIdPhoto);
      if (property == "drivingLincenceIdNumber")
        print(accessDb->drivingLincenceIdNumber);
      if (property == "drivingLincenceIdPhoto")
        print(accessDb->drivingLincenceIdPhoto);
      if (property == "street")
        print(accessDb->street);
      if (property == "city")
        print(accessDb->city);
      if (property == "proofOfAddress")
        print(accessDb->proofOfAddress);
      if (property == "certifiedIncome")
        print(accessDb->certifiedIncome);
      if (property == "country")
        print(accessDb->country);
    }
  }

  void datadeleted(account_name user, uint64_t applicationId, std::string property)
  {
    require_auth(user);

    access_index accesses(_self, _self);

    auto accessDb = accesses.find(applicationId * 1000000 + user);
    if (accessDb == accesses.end())
    {
      print("Users is not registered in this service");
    }
    else
    {
      if (property == "firstname")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.firstname = setFlag(updateAccess.firstname, "deleted");
        });
      if (property == "lastname")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.lastname = setFlag(updateAccess.lastname, "deleted");
        });
      if (property == "email")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.email = setFlag(updateAccess.email, "deleted");
        });
      if (property == "phoneNumber")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.phoneNumber = setFlag(updateAccess.phoneNumber, "deleted");
        });
      if (property == "liveIdPhoto")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.liveIdPhoto = setFlag(updateAccess.liveIdPhoto, "deleted");
        });
      if (property == "govIdNumber")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.govIdNumber = setFlag(updateAccess.govIdNumber, "deleted");
        });
      if (property == "govIdPhoto")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.govIdPhoto = setFlag(updateAccess.govIdPhoto, "deleted");
        });
      if (property == "passportIdNumber")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.passportIdNumber = setFlag(updateAccess.passportIdNumber, "deleted");
        });
      if (property == "passportIdPhoto")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.passportIdPhoto = setFlag(updateAccess.passportIdPhoto, "deleted");
        });
      if (property == "drivingLincenceIdNumber")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.drivingLincenceIdNumber = setFlag(updateAccess.drivingLincenceIdNumber, "deleted");
        });
      if (property == "drivingLincenceIdPhoto")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.drivingLincenceIdPhoto = setFlag(updateAccess.drivingLincenceIdPhoto, "deleted");
        });
      if (property == "street")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.street = setFlag(updateAccess.street, "deleted");
        });
      if (property == "city")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.city = setFlag(updateAccess.city, "deleted");
        });
      if (property == "proofOfAddress")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.proofOfAddress = setFlag(updateAccess.proofOfAddress, "deleted");
        });
      if (property == "certifiedIncome")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.certifiedIncome = setFlag(updateAccess.certifiedIncome, "deleted");
        });
      if (property == "country")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.country = setFlag(updateAccess.country, "deleted");
        });
    }
  }

  void datanotdel(account_name user, uint64_t applicationId, std::string property)
  {
    require_auth(user);

    access_index accesses(_self, _self);

    auto accessDb = accesses.find(applicationId * 1000000 + user);
    if (accessDb == accesses.end())
    {
      print("Users is not registered in this service");
    }
    else
    {
      if (property == "firstname")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.firstname = setFlag(updateAccess.firstname, "notDeleted");
        });
      if (property == "lastname")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.lastname = setFlag(updateAccess.lastname, "notDeleted");
        });
      if (property == "email")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.email = setFlag(updateAccess.email, "notDeleted");
        });
      if (property == "phoneNumber")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.phoneNumber = setFlag(updateAccess.phoneNumber, "notDeleted");
        });
      if (property == "liveIdPhoto")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.liveIdPhoto = setFlag(updateAccess.liveIdPhoto, "notDeleted");
        });
      if (property == "govIdNumber")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.govIdNumber = setFlag(updateAccess.govIdNumber, "notDeleted");
        });
      if (property == "govIdPhoto")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.govIdPhoto = setFlag(updateAccess.govIdPhoto, "notDeleted");
        });
      if (property == "passportIdNumber")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.passportIdNumber = setFlag(updateAccess.passportIdNumber, "notDeleted");
        });
      if (property == "passportIdPhoto")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.passportIdPhoto = setFlag(updateAccess.passportIdPhoto, "notDeleted");
        });
      if (property == "drivingLincenceIdNumber")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.drivingLincenceIdNumber = setFlag(updateAccess.drivingLincenceIdNumber, "notDeleted");
        });
      if (property == "drivingLincenceIdPhoto")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.drivingLincenceIdPhoto = setFlag(updateAccess.drivingLincenceIdPhoto, "notDeleted");
        });
      if (property == "street")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.street = setFlag(updateAccess.street, "notDeleted");
        });
      if (property == "city")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.city = setFlag(updateAccess.city, "notDeleted");
        });
      if (property == "proofOfAddress")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.proofOfAddress = setFlag(updateAccess.proofOfAddress, "notDeleted");
        });
      if (property == "certifiedIncome")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.certifiedIncome = setFlag(updateAccess.certifiedIncome, "notDeleted");
        });
      if (property == "country")
        accesses.modify(accessDb, _self, [&](auto &updateAccess) {
          updateAccess.country = setFlag(updateAccess.country, "notDeleted");
        });
    }
  }

private:
  std::string setFlag(std::string origin, std::string flag)
  {
    std::size_t index = origin.find(":");

    if (index == std::string::npos)
    {
      return origin + ":" + flag;
    }

    return origin.substr(0, index + 1) + flag;
  }

  struct user
  {
    account_name id;
    std::string firstname;
    std::string lastname;
    std::string email;
    std::string phoneNumber;
    std::string liveIdPhoto;
    std::string govIdNumber;
    std::string govIdPhoto;
    std::string passportIdNumber;
    std::string passportIdPhoto;
    std::string drivingLincenceIdNumber;
    std::string drivingLincenceIdPhoto;
    std::string street;
    std::string city;
    std::string proofOfAddress;
    std::string certifiedIncome;
    std::string country;

    uint64_t primary_key() const { return id; }
  };

  typedef eosio::multi_index<N(users), user>
      user_index;

  struct access
  {
    account_name userId;
    uint64_t applicationId;
    std::string firstname;
    std::string lastname;
    std::string email;
    std::string phoneNumber;
    std::string liveIdPhoto;
    std::string govIdNumber;
    std::string govIdPhoto;
    std::string passportIdNumber;
    std::string passportIdPhoto;
    std::string drivingLincenceIdNumber;
    std::string drivingLincenceIdPhoto;
    std::string street;
    std::string city;
    std::string proofOfAddress;
    std::string certifiedIncome;
    std::string country;

    uint64_t primary_key() const { return applicationId * 1000000 + userId; }
  };

  typedef eosio::multi_index<N(access), access> access_index;
};

EOSIO_ABI(perseos, (createuser)(createaccess)(getuserdata)(datadeleted)(datanotdel))
