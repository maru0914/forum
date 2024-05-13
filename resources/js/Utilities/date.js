import {formatDistance, parseISO} from "date-fns";
import {ja} from "date-fns/locale";

const relativeDate = (date) => formatDistance(
    parseISO(date),
    new Date(),
    {
        locale: ja,
        addSuffix: true
    });

export {
    relativeDate
};
