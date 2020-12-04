import time
import re


def main():
    with open ("inputs/day4.php") as inputfile:
        passports = inputfile.read().split('\n\n')

    start_time = time.time()
    print("Day 4, problem 2")

    ptotal = 0
    pvalid = 0
    pinvalid = 0

    for p in passports:
        ptotal += 1
        if valid_passport(p):
            pvalid += 1
        else:
            pinvalid += 1

    print("Total Passports   : {}".format(ptotal))
    print("Valid Passports   : {}".format(pvalid))
    print("Invalid Passports : {}".format(pinvalid))

    end_time = time.time()
    time_ms = (end_time - start_time) * 1000
    print("Time taken: {}ms".format(round(time_ms, 3)))


def valid_passport(passport):
    required = ["byr:", "iyr:", "eyr:", "hgt:", "hcl:", "ecl:", "pid:"]
    valid_ecl = ["amb", "blu", "brn", "gry", "grn", "hzl", "oth"]
    passport = passport.replace("\n", " ")

    for r in required:
        if r not in passport:
            return False

    pdata = passport.split(" ")
    for p in pdata:
        pairs = p.split(":")
        if len(pairs) < 2:
            continue

        key = pairs[0]
        val = pairs[1]

        if key == "byr":
            if len(val) < 4:
                return False
            val = int(val)
            if val < 1920 or val > 2002:
                return False
            continue

        if key == "iyr":
            if len(val) < 4:
                return False
            val = int(val)
            if val < 2010 or val > 2020:
                return False
            continue

        if key == "eyr":
            if len(val) < 4:
                return False
            val = int(val)
            if val < 2020 or val > 2030:
                return False
            continue

        if key == "hgt":
            height = int(re.findall(r'\d+', val)[0])
            units = val.replace(str(height), '')
            if units == "cm":
                if height < 150 or height > 193:
                    return False
            elif units == "in":
                if height < 59 or height > 76:
                    return False
            else:
                return False
            continue

        if key == "hcl":
            match = "^#([A-Fa-f0-9]{6})$"
            if len(re.findall(match, val)) != 1:
                return False
            continue

        if key == "ecl":
            if val not in valid_ecl:
                return False
            continue

        if key == "pid":
            if len(val) != 9:
                return False
            continue

    return True

if __name__ == '__main__':
    main()
